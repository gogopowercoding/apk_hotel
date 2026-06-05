<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Room extends Model {
    protected $fillable = ['code','type','price','capacity','stock','facilities','description','status'];
    public function bookings(){ return $this->hasMany(Booking::class); }
}
