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
        $data = ['category' =>[
            'Popular-movies' => [],
            'K-drama-movies' => [],
            'TV-Entertainment' => [],
            'movies' => [],
            'foreign-drama' => [],
            'Japanes-cartoon' => [],
            ],
            '0' => ''
        ];
        $Movies = DB::table('titles')
        ->join('videos', 'videos.title_id', 'titles.id')
        ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
        ->OrderBy('titles.created_at', 'DESC')
        ->get();
        if(!$Movies->isEmpty()){
            foreach($Movies as $item){
                if ($item->name === "k-drama") {
                    $data['category']['K-drama-movies'][] = $item;
                }   
                if ($item->name === "popular") {
                    $data['category']['Popular-movies'][] = $item;
                }
                if ($item->name === "entertain") {
                    $data['category']['TV-Entertainment'][] = $item;
                }
                if ($item->name === "movies") {
                    $data['category']['movies'][] = $item;
                }
                if ($item->name === "foreign drama") {
                    $data['category']['foreign-drama'][] = $item;
                }
            }
        }else{
            $data['0'] = 'Data not found!';        
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
        $data['movies'] = DB::table('titles')
        ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
        ->join('videos', 'videos.title_id', 'titles.id')
        ->where('movie_category.name', $category)
        ->paginate(21);
        return view('front.popular', compact('session', 'data'));
    }

    
    public function videoWach($CategoryName, $part, $titleId, Request $request){
        $session = Session();
        $user_Ip = $request->ip();
        $data['targetMovie'] = DB::table('videos')
        ->select(
            'videos.id', 
            'titles.title', 
            'videos.episode', 
            'videos.link',
            'videos.episode',
            'titles.movei_cover_path',
            'titles.description'
        ) 
        ->join('titles', 'titles.id', 'videos.title_id')
        ->join('viewer', 'viewer.videos_id', 'videos.id')
        ->where('titles.title', $titleId)
        ->where('videos.episode', $part)
        ->first();

        $viewer_exed = DB::table('viewer')
        ->select('viewer_ip')
        ->where('viewer_ip', $user_Ip)
        ->where('videos_id', $data['targetMovie']->id)
        ->first();

        if(Session()->has('admin_name')){
            $exVTR = DB::table('history')
            ->where('video_id', $data['targetMovie']->id)
            ->where('user_id', Session()->get('admin_id'))
            ->first();
            if(!$exVTR){
                DB::table('history')->insert([
                    'user_id' => Session()->get('admin_id'),
                    'video_id' => $data['targetMovie']->id
                ]);
            }
        }
        
        if(!$viewer_exed){
            DB::table('viewer')->insert([
                'viewer_ip' => $user_Ip,
                'videos_id' => $video_id->id
            ]);
        }

        $data['comments'] = DB::table('comment')
        ->where('video_id', $data['targetMovie']->id)
        ->get();

        $data['video_viewers'] = DB::table('viewer')
        ->where('videos_id', $data['targetMovie']->id)
        ->get();
        $data['viewer_count'] = $data['video_viewers']->count();

        $data['recommend'] = DB::table('titles')
        ->join('videos', 'videos.title_id', 'titles.id')
        ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
        ->OrderBy('titles.created_at', 'DESC')
        ->get();
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
    
    public function details(Request $request)
    {
        $movieId = $request->query('id');
        $movieDetail = DB::table('titles')
            ->join('videos', 'videos.title_id', 'titles.id')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->where('titles.id', $movieId)
            ->first();
    
        if ($movieDetail) {
            // Assuming your movie model has 'title' and 'description' properties
            return response()->json([
                'moviesDetail' => $movieDetail
            ]);
        } else {
            // Movie not found
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }

    public function listChart(){
        return view('front/noteList');
    }
    public function notice(){
        return view('front/noteList');
    }

    public function leaveComment(Request $request){
        $insert = [];
        if($request->has('email') && $request->has('name')){
            $insert = [
                'user_name' => $request->input('name'),
                'user_email' => $request->input('email'),
                'comment' => $request->input('comment'),
                'video_id' => $request->input('videoId')
            ];
        } else {
            $insert = [
                'user_name' => Session()->get('admin_name'),
                'user_email' => Session()->get('admin_email'),
                'comment' => $request->input('comment'),
                'video_id' => $request->input('videoId')
            ];
        }
        try {
            if(!empty($insert)){
                DB::table('comment')->insert($insert);
                $data['comments'] = DB::table('comment')
                                  ->where('video_id', $request->input('videoId'))
                                  ->get();
                return response()->json(['success' => true, 'comments' => $data]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
     
}
