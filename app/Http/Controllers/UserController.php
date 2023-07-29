<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reservation;
use App\Models\Favorite;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function mypage()
    {
        if (Auth::check()) {

            $reservations = Reservation::where('user_id', Auth::user()->id)->get();

            $favoriteStores = Favorite::with('store')->where('user_id', Auth::user()->id)->get();

            return view('mypage', compact('reservations', 'favoriteStores'));
        } else {
            return redirect()->route('login'); 
        }
    }

    public function update(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        $reservation->reserved_date = $request->input('reserved_date');
        $reservation->reserved_time = $request->input('reserved_time');
        $reservation->number_of_guests = $request->input('number_of_guests');
        $reservation->save();

        return redirect()->route('mypage'); 
    }


}