<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\Favorite;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StoreController extends Controller
{
    public function index()
    {
        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id')->toArray();
        }

        $stores = Store::all();
        return view('index', compact('stores', 'favoriteIds'));
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $area = $request->input('area');
        $genre = $request->input('genre');

        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id')->toArray();
        }

        $stores = Store::query()
            ->when($area !== 'all', function ($query) use ($area) {
                return $query->where('area_id', $area);
            })
            ->when($genre !== 'all', function ($query) use ($genre) {
                return $query->where('genre_id', $genre);
            })
            ->where(function ($query) use ($keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")
                    ->orWhere('shop_text', 'LIKE', "%{$keyword}%");
            })
            ->get();

        return view('index', compact('stores', 'favoriteIds'));
    }

    public function show($id)
    {
        $favoriteIds = [];
        if (Auth::check()) {
            $favoriteIds = Favorite::where('user_id', Auth::user()->id)->pluck('restaurant_id')->toArray();
        }

        $store = Store::find($id);

        $evaluations = Evaluation::where('restaurant_id', $id)->get();

        $evaluations = $evaluations ?? collect();

        return view('detail', compact('store', 'favoriteIds', 'evaluations'));
    }

    public function evaluate($id)
    {
        $store = Store::find($id);

        return view('evaluate', compact('store'));
    }

    public function storeEvaluation(Request $request, $id)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|between:1,5',
        ]);

        $restaurant = Store::find($id);

        if (!$restaurant) {
            return redirect()->back()->withErrors(['error' => 'レストランが見つかりません']);
        }

        $evaluation = new Evaluation();
        $evaluation->user_id = auth()->user()->id; 
        $evaluation->restaurant_id = $restaurant->id; 
        $evaluation->name = $request->input('name'); 
        $evaluation->comment = $request->input('comment'); 
        $evaluation->rating = $request->input('rating'); 
        $evaluation->save();

        return redirect()->route('mypage')->with('success', 'レビューを投稿しました。');
    }

    

}
