<?php
namespace App\Http\Controllers;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminRoomController extends Controller {
    private function adminOnly(){ abort_unless(Auth::user()->isAdmin(),403); }
    public function index(){ $this->adminOnly(); return view('admin.rooms.index',['rooms'=>Room::latest()->paginate(10)]); }
    public function create(){ $this->adminOnly(); return view('admin.rooms.form',['room'=>new Room]); }
    public function store(Request $r){ $this->adminOnly(); Room::create($this->validated($r)); return redirect()->route('admin.rooms.index')->with('success','Kamar berhasil ditambahkan.'); }
    public function edit(Room $room){ $this->adminOnly(); return view('admin.rooms.form',compact('room')); }
    public function update(Request $r, Room $room){ $this->adminOnly(); $room->update($this->validated($r)); return redirect()->route('admin.rooms.index')->with('success','Kamar berhasil diperbarui.'); }
    public function destroy(Room $room){ $this->adminOnly(); $room->delete(); return back()->with('success','Kamar dihapus.'); }
    private function validated(Request $r){ return $r->validate(['code'=>'required|max:20','type'=>'required|max:100','price'=>'required|integer|min:1','capacity'=>'required|integer|min:1|max:10','stock'=>'required|integer|min:0|max:100','facilities'=>'nullable|max:255','description'=>'nullable|max:500','status'=>'required|in:available,unavailable']); }
}
