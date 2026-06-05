<?php
namespace App\Http\Controllers;
use App\Models\{Room,Booking,Payment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class CustomerBookingController extends Controller {
    public function index(){ $bookings=Booking::with(['room','payment'])->where('user_id',Auth::id())->latest()->get(); return view('customer.bookings.index',compact('bookings')); }
    public function create(Room $room){ abort_if($room->stock<=0,400,'Stok kamar habis'); return view('customer.bookings.create',compact('room')); }
    public function store(Request $r, Room $room){
        $data=$r->validate(['check_in'=>'required|date|after_or_equal:today','nights'=>'required|integer|min:1|max:30','guests'=>'required|integer|min:1|max:'.$room->capacity]);
        if($room->stock<=0) return back()->withErrors(['room'=>'Stok kamar habis.']);
        return DB::transaction(function() use($data,$room){
            $checkIn=Carbon::parse($data['check_in']); $nights=(int)$data['nights']; $total=$room->price*$nights;
            $booking=Booking::create(['booking_code'=>'HTL-'.date('Ymd').'-'.str_pad((string)(Booking::count()+1),4,'0',STR_PAD_LEFT),'user_id'=>Auth::id(),'room_id'=>$room->id,'check_in'=>$checkIn,'check_out'=>$checkIn->copy()->addDays($nights),'nights'=>$nights,'guests'=>$data['guests'],'total_price'=>$total,'status'=>'waiting_payment']);
            $room->decrement('stock');
            return redirect()->route('customer.bookings.index')->with('success','Booking dibuat. Silakan lakukan pembayaran.');
        });
    }
    public function pay(Request $r, Booking $booking){
        abort_unless($booking->user_id===Auth::id(),403);
        $data=$r->validate(['amount_paid'=>'required|integer|min:1','method'=>'required|in:cash,transfer']);
        if($data['amount_paid'] < $booking->total_price) return back()->withErrors(['amount_paid'=>'Nominal pembayaran kurang dari total biaya.']);
        Payment::updateOrCreate(['booking_id'=>$booking->id],['amount_paid'=>$data['amount_paid'],'change_amount'=>$data['amount_paid']-$booking->total_price,'method'=>$data['method'],'status'=>'paid','paid_at'=>now()]);
        $booking->update(['status'=>'paid']); return back()->with('success','Pembayaran berhasil. Menunggu konfirmasi admin.');
    }
    public function checkout(Booking $booking){ abort_unless($booking->user_id===Auth::id(),403); if($booking->status==='confirmed') $booking->update(['status'=>'completed']); return back()->with('success','Checkout berhasil.'); }
    public function destroy(Booking $booking){ abort_unless($booking->user_id===Auth::id(),403); if(in_array($booking->status,['waiting_payment','paid'])){ $booking->room->increment('stock'); $booking->update(['status'=>'cancelled']); } return back()->with('success','Booking dibatalkan.'); }
}
