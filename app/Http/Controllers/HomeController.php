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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use CRUDBooster;
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
    public function index(Request $request)
    {
        $ip =  $request->ip();
        $userAgent = $request->userAgent();
        $referrer = $request->headers->get('/');
        $visitor = DB::table('website_visitors')->where('ip_address', $ip)->first();
        if (!$visitor) {
           DB::table('website_visitors')->insert([
                'ip_address' => $ip,
                'user_agent' => $userAgent,
                'referrer' => $referrer
            ]);
        }
        $session = Session();
        $data['sponsor_banner'] = DB::table('sponsor_banner')
        ->select('banner_path')
        ->where('status', '')
        ->get();
        return view('front.home', compact('session', 'data'));
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
    public function requstEdite($username, $user_id, Request $request) {
        $data['userInfo'] = DB::table('cms_users')
            ->select()
            ->where('id', $user_id)
            ->first();
    
        if ($request->has('userpassword')) {
            $newpassword = $request->input('userpassword');
            if (!Hash::check($newPassword, $data['userInfo']->password)) {
                return response()->json(['Errors' => 'Sorry, your current password input is not correct!', 'correntpass' => $newpassword,'pass'=>$data['userInfo']->password], 400);
            }
        }
    
        $updateData = [];

        if ($request->has('user-name')) {
            $updateData['name'] = $request->input('user-name');
        }
    
        if ($request->has('email')) {
            $updateData['email'] = $request->input('email');
        }

        if ($request->hasFile('profile')) {
            $profile = $request->file('profile');
            $fileName = uniqid() . '.' . $profile->getClientOriginalExtension();
            $profile->move(public_path('uploads'), $fileName);
            $updateData['photo'] = 'uploads/'.$fileName; 
        }
    
        if ($request->has('userpassword')) {
            $updateData['password'] = $newpassword;
        }
        if (!empty($updateData)) {
                $userUpdate = DB::table('cms_users')->where('id', $user_id)->update($updateData);
                if ($userUpdate) {
                    $data['newUserInfo'] = DB::table('cms_users')
                    ->select()
                    ->where('id', $user_id)
                    ->first();
                    Session::put('admin_name', $data['newUserInfo']->name);
                    Session::put('admin_email', $data['newUserInfo']->email);
                    Session::put('admin_photo', $data['newUserInfo']->photo);
                return response()->json(["Success" => "Success Updated", "data" => $data]);
                } else {
                    return response()->json(["Errors" => "Something wrong"]);
                }
        }else{
            return response()->json(["Errors" => "Something wrong"]);
        }
    }
    
    public function registerPost(Request $request) {
        $appUser = DB::table('cms_users')
        ->select('email')
        ->where('email', $request->input('user-email'))
            ->first();
        
        if ($appUser) {
            return response()->json(['Error' => 'Sorry, your email already exists!']);
        } else {
            $newUser = DB::table('cms_users')
                ->insert([
                    'name' => $request->input('user-name'),
                    'email' => $request->input('user-email'),
                    'password' => Hash::make($request->input('password')),
                    'id_cms_privileges' => 2
                ]);
        
            if ($newUser) {
                return response()->json(['Success' => 'Thank you for joining us']);
            } else {
                return response()->json(['Error' => 'Sorry, something went wrong!']);
            }
        }
    }
}
