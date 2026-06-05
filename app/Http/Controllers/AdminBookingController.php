<?php
namespace App\Http\Controllers;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
class AdminBookingController extends Controller {
    private function adminOnly(){ abort_unless(Auth::user()->isAdmin(),403); }
    public function index(){ $this->adminOnly(); return view('admin.bookings.index',['bookings'=>Booking::with(['user','room','payment'])->latest()->get()]); }
    public function confirm(Booking $booking){ $this->adminOnly(); if($booking->status==='paid') $booking->update(['status'=>'confirmed']); return back()->with('success','Booking dikonfirmasi.'); }
    public function cancel(Booking $booking){ $this->adminOnly(); if(!in_array($booking->status,['completed','cancelled'])){ $booking->room->increment('stock'); $booking->update(['status'=>'cancelled']); } return back()->with('success','Booking dibatalkan.'); }
}
