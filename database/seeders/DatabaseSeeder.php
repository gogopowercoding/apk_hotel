<?php
namespace Database\Seeders;
use App\Models\{User,Room};
use Illuminate\Database\Seeder; use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder { public function run(): void { User::updateOrCreate(['email'=>'admin@hotel.test'],['name'=>'Admin Hotel','password'=>Hash::make('admin123'),'role'=>'admin']); User::updateOrCreate(['email'=>'budi@hotel.test'],['name'=>'Budi','password'=>Hash::make('budi123'),'role'=>'customer']); $rooms=[['code'=>'STD','type'=>'Standard','price'=>300000,'capacity'=>2,'stock'=>5,'facilities'=>'AC, TV, WiFi'],['code'=>'DLX','type'=>'Deluxe','price'=>600000,'capacity'=>3,'stock'=>3,'facilities'=>'AC, TV 42, WiFi, Bathtub, Minibar'],['code'=>'STE','type'=>'Suite','price'=>1200000,'capacity'=>4,'stock'=>2,'facilities'=>'AC, TV 55, WiFi, Jacuzzi, Minibar']]; foreach($rooms as $r) Room::updateOrCreate(['code'=>$r['code']],$r+['status'=>'available']); }}
