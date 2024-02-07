<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Product;
use App\Cart;  
use App\CartItem;  
use App\Order;
use App\OrderItem;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $session = Session();
        return view('front.home', compact('session'));
    }
    public function PageCategory($category)
    {
        $session = Session();
        return view('front.popular', compact('session'));
    }
    public function videoWach($CategoryName, $part, $movieTile){
        $session = Session();
        $data['accessPoint']  = [$CategoryName, $part, $movieTile];
        return view('front.waching-vtr', compact('data', 'session')); 
    }
  

    public function requstEdite($username, Request $request) {
        $userName = $request->input('user-name');
        $email = $request->input('email');
        $profile = $request->input('profile');
        $userPassword = $request->input('userpassword');
        $data['userInfo'] = DB::table('cms_users')
        ->select()
        ->where('name', $username)
        ->first();
        return response()->json(["Success" => "Success Updated", "data" => $data]);
        //return response()->json(["Errors" => "Something wrong"]);
    }
    
}
