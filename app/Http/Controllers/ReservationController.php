<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Evaluation; 

class ReservationController extends Controller
{
  public function store(Request $request)
  {
    if (!Auth::check()) {
      return redirect()->route('login')->with('error', '予約するにはログインしてください');
    }

    $reservation = new Reservation();
    $reservation->user_id = Auth::id();
    $reservation->restaurant_id = $request->input('restaurant_id');
    $reservation->reserved_date = $request->input('date');
    $reservation->reserved_time = $request->input('time');
    $reservation->number_of_guests = $request->input('guests');
    $reservation->save();

    return view('done');
  }

  public function delete(Request $request)
  {
    $reservationId = $request->input('reservationId');

    $reservation = new Reservation();
    $result = $reservation->deleteReservation($reservationId);

    if ($result) {
      return response()->json(['success' => true]);
    } else {
      return response()->json(['success' => false, 'message' => '予約の削除に失敗しました']);
    }
  }

  public function restaurant()
  {
    return $this->belongsTo(Store::class, 'restaurant_id');
  }

  

}
