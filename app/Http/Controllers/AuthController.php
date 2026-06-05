<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller {
    public function showLogin(){ return view('auth.login'); }
    public function showRegister(){ return view('auth.register'); }
    public function register(Request $r){
        $data=$r->validate(['name'=>'required|min:3|max:100','email'=>'required|email|unique:users,email','password'=>'required|min:6|confirmed']);
        $data['password']=Hash::make($data['password']); $data['role']='customer'; User::create($data);
        return redirect()->route('login')->with('success','Registrasi berhasil. Silakan login.');
    }
    public function login(Request $r){
        $cred=$r->validate(['email'=>'required|email','password'=>'required']);
        if(Auth::attempt($cred)){ $r->session()->regenerate(); return redirect()->route('dashboard'); }
        return back()->withErrors(['email'=>'Email atau password salah.'])->onlyInput('email');
    }
    public function dashboard(){
        $u=Auth::user();
        return $u->isAdmin() ? redirect()->route('admin.rooms.index') : redirect()->route('customer.rooms.index');
    }
    public function logout(Request $r){ Auth::logout(); $r->session()->invalidate(); $r->session()->regenerateToken(); return redirect()->route('login'); }
}
