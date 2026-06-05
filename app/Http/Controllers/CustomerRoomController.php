<?php
namespace App\Http\Controllers;
use App\Models\Room;
class CustomerRoomController extends Controller { public function index(){ return view('customer.rooms.index',['rooms'=>Room::where('status','available')->get()]); } }
