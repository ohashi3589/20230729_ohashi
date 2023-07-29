<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function addFavorite(Request $request)
    {
        $userId = $request->input('user_id');
        $storeId = $request->input('store_id');

        $store = Store::find($storeId);
        $store->users()->attach($userId);

        return response()->json([]);
    }

    public function removeFavorite($storeId)
    {
        $store = Store::find($storeId);
        $store->users()->detach();

        return response()->json([]);
    }
}
