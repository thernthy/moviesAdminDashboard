<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
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
    protected $keywords = [];
    public function __construct(){
            $keywords = DB::table('keywords')->pluck('title')->toArray();
            $this->keywords = $keywords;
    }
//==========================================================//
//=======          Function Index page           ==========//
//========================================================//
    public function index(Request $request){
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
            'Cartoon' => [],
            ],
            '0' => ''
        ];
        $Movies = DB::table('titles')
        ->select(
        'titles.id as title_id', 
        'titles.movie_category_id',
        'titles.title', 
        'titles.movei_cover_path', 
        'titles.created_at', 
        'movie_category.id', 
        'movie_category.name')
        ->join('movie_category', 'movie_category.id', '=', 'titles.movie_category_id')
        ->orderBy('titles.created_at', 'DESC')
        ->where('titles.status', 1)
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
                if ($item->name === "Movies") {
                    $data['category']['movies'][] = $item;
                }
                if ($item->name === "foreign drama") {
                    $data['category']['foreign-drama'][] = $item;
                }
                if ($item->name === "cartoon") {
                    $data['category']['Cartoon'][] = $item;
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
        $data['key_words'] = $this->keywords;
        return view('front.home', compact('session', 'data'));
    }


//==========================================================//
//=======    Function for return category page   ==========//
//========================================================//
    public function PageCategory($category){
        $data['pageTitle'] = $category;
        $session = Session();
        $data['movies'] = DB::table('titles')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->join('videos', function($join) {
                $join->on('videos.title_id', '=', 'titles.id')
                     ->where(function($query) {
                         $query->where('videos.episode', 1)
                               ->orWhere('videos.episode', 0);
                     });
            })
            ->where('movie_category.name', $category)
            ->where('titles.status', 1)
            ->orderBy('titles.created_at','DESC')
            ->paginate(21);
        $data['key_words'] = $this->keywords;
        return view('front.popular', compact('session', 'data'));
    }


//===========================================================//
//=======    Funcitons for return waching video   ==========//
//=========================================================//
    public function videoWach($CategoryName, $part, $titleId, Request $request){
        $session = Session();
        $user_Ip = $request->ip();
        $data['targetMovie'] = '';
        $data['key_words'] = $this->keywords;
        $data['keywords'] = DB::table('keywords')->get();
        
        //get all videos from db
        $data['Movies'] = DB::table('videos')
        ->select(
            'videos.id as video_id', 
            'titles.title', 
            'videos.episode', 
            'videos.link',
            'videos.episode',
            'titles.movei_cover_path',
            'titles.description',
            'movie_category.id',
            'movie_category.name',
            'titles.keyword_id',
            'directors.name as director',
            'directors.id'
        ) 
        ->join('titles', 'titles.id', 'videos.title_id')
        ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
        ->join('directors', 'directors.id', 'titles.actors_id')
        ->where('titles.title', $titleId)
        ->get();
        
        foreach($data['Movies'] as $movie){
            if($movie->episode == $part){
                $data['targetMovie'] = $movie;
            }
        }
        
        //get viewers for make sure
        $viewer_exed = DB::table('viewer')
        ->select('viewer_ip')
        ->where('viewer_ip', $user_Ip)
        ->where('videos_id', $data['targetMovie']->video_id)
        ->first();
        //when user not wached this video yet
        if(!$viewer_exed){
            DB::table('viewer')->insert([
                'viewer_ip' => $user_Ip,
                'videos_id' => $data['targetMovie']->video_id
            ]);
        }
        
        //if user login this will store history wached
        if(Session()->has('admin_name')){
            $exVTR = DB::table('history')
            ->where('video_id', $data['targetMovie']->video_id)
            ->where('user_id', Session()->get('admin_id'))
            ->first();
            if(!$exVTR){
                DB::table('history')->insert([
                    'user_id' => Session()->get('admin_id'),
                    'video_id' => $data['targetMovie']->video_id
                ]);
            }
            $data['favorited'] = DB::table('favorite_movies')
            ->where('user_id', Session()->get('admin_id'))
            ->where('video_id', $data['targetMovie']->video_id)
            ->first();
        }
        

        //get user comments from db when page has been request
        $data['comments'] = DB::table('comment')
        ->where('video_id', $data['targetMovie']->video_id)
        ->leftJoin('cms_users', 'cms_users.email', '=', 'comment.user_email')
        ->orderBy('comment.created_at','DESC')
        ->get();
        
        //get all viewers from db base on video tartget waching 
        $data['video_viewers'] = DB::table('viewer')
        ->where('videos_id', $data['targetMovie']->video_id)
        ->get();
        $data['viewer_count'] = $data['video_viewers']->count();//count video waching viewers
        
        //get recommend video base on category video waching
        $data['recommend'] = DB::table('titles')
        ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
        ->join('videos', function($join) {
                $join->on('videos.title_id', '=', 'titles.id')
                     ->where(function($query) {
                         $query->where('videos.episode', 1)
                               ->orWhere('videos.episode', 0);
                     });
                 })
        ->OrderBy('titles.created_at', 'DESC')
        ->where('movie_category.name', $CategoryName)
        ->where('titles.title', '!=', $titleId)
        ->where('titles.status',  1)
        ->get();
        
        //check video waching if it has multiple link serve or not
        $linkArray = json_decode($data['targetMovie']->link, true);
        if (is_array($linkArray)) {
            return view('front.waching-vtr-array', compact('data', 'session'));
        } else {
            return view('front.waching-vtr', compact('data', 'session'));
        }
    }
    
    
//========================================================//
//=======    ajax  user edite informaction     ==========//
//======================================================//
    public function requstEdite($username, $user_id, Request $request) {
        $data['userInfo'] = DB::table('cms_users')
            ->select()
            ->where('id', $user_id)
            ->first();
    
        $updateData = [];
        if ($request->has('password')) {
            $newpassword = $request->input('password');
            if (!Hash::check($newpassword, $data['userInfo']->password)) {
                return response()->json(['Sorry, your current password input is not correct!'], 400);
            }else{
               $updateData['password'] = Hash::make($request->input('newpass'));
            }
        }
    

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
    
    
    
//========================================================//
//=======      ajax user  registeration        ==========//
//======================================================//
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
                    'id_cms_privileges' => 3
                ]);
            if ($newUser) {
                return response()->json(['Success' => 'Thank you for joining us']);
            } else {
                return response()->json(['Error' => 'Sorry, something went wrong!']);
            }
        }
    }
    
    
//========================================================//
//=======    ajax request for detail movie     ==========//
//======================================================//
    public function details(Request $request){
        $movieId = $request->query('id');
        $movieDetail = DB::table('titles')
            ->select(
                'videos.id as video_id', 
                'titles.description',
                'titles.movei_cover_path',
                'movie_category.name',
                'titles.title',
                'videos.episode',
                'titles.keyword_id'
                )
            ->join('videos', 'videos.title_id', 'titles.id')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->where('titles.id', $movieId)
            ->first();
        $movieSave = DB::table('save_movies')
            ->where('video_id', $movieDetail->video_id)
            ->first();
        $keyworsData = DB::table('keywords')->get();
        $keywords = false;
        $converdId = unserialize($movieDetail->keyword_id);
        foreach($keyworsData as $key){
            if (is_array($converdId) && in_array($key->id, $converdId)) {
                $keywords[] = $key;
            }
        }
        
        if ($movieDetail) {
            return response()->json([
                'moviesDetail' => $movieDetail,
                'saveMovie' => $movieSave,
                'keywords' => $keywords
            ]);
        } else {
            return response()->json(['error' => 'Movie not found'], 404);
        }
    }

    public function listChart(){
        return view('front/noteList');
    }
    
    public function notice(){
        return view('front/noteList');
    }


//========================================================//
//=======         ajax comment video           ==========//
//======================================================//
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
                                  ->leftJoin('cms_users', 'cms_users.email', '=', 'comment.user_email')
                                  ->where('comment.video_id', $request->input('videoId'))
                                  ->orderBy('comment.created_at','DESC')
                                  ->get();
                return response()->json(['success' => true, 'comments' => $data]);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
     
     
//========================================================//
//=======         ajax request  faovite        ==========//
//======================================================//
    public function favoriteHandle(Request $request){
        $favorite = DB::table('favorite_movies')
        ->where('user_id', Session()->get('admin_id'))
        ->where('video_id', $request->input('video_id'))
        ->first();
        if(!$favorite){
            DB::table('favorite_movies')
            ->insert([
                'user_id' => $request->input('userId'),
                'video_id' => $request->input('video_id')
            ]);
           return response()->json(['favorited-set' => $favorite]);
        }
        return response()->json(['favorited-set' => $favorite]);
    }
    
    
//========================================================//
//=======     ajax request save movie          ==========//
//======================================================//
    public function saveMovies(Request $request){
        $savedMovie = DB::table('save_movies')
                        ->where('video_id', $request->input('video_id'))
                        ->first();
        if(!$savedMovie){
            $insert = DB::table('save_movies')->insert([
                'user_id' => $request->input('userId'),
                'video_id' => $request->input('video_id')
            ]);
    
            if($insert){
                return response()->json(['success' => 'ok']);
            }
        }
    }



//========================================================//
//=======     seach functions                  ==========//
//======================================================//
    public function searchHandle(Request $request){
        $query = $request->input('query');
        $searchResults = [];
        $movieTitle = DB::table('titles')
            ->join('videos', 'videos.title_id', 'titles.id')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->where('titles.title', 'LIKE', "%{$query}%")
            ->where('videos.episode', '!=', '')
            ->get();
        
        if ($movieTitle->isEmpty()) {
            $keyWork = DB::table('keywords')
                ->where('title', 'LIKE', "%{$query}%")
                ->orWhere('id', 'LIKE', "%{$query}%")
                ->get();
        
            if ($keyWork->isEmpty()) {
                return response()->json(["message" => "No results found."]);
            } else {
                return response()->json(["message" => "Keyword found!", "keywords" => $keyWork]);
            }
        } else {
            $searchResults = $movieTitle;
        }
        return response()->json(["message" => "Search results found.", "results" => $searchResults]);
    }
    
    
    
//========================================================//
//=======    Function reture keyworks view     ==========//
//======================================================//
    public function keyword(Request $request){
        $session = Session();
        $token = $request->query('tk');
        $key = $request->query('key');
        $title = $request->query('tt');
        $keyword = false;
        $data['movies'] = [];
        $data['title'] = $title;
        $data['key_words'] = $this->keywords;
        $movies = DB::table('titles')
            ->join('movie_category', 'movie_category.id', 'titles.movie_category_id')
            ->join('videos', function($join) {
                $join->on('videos.title_id', '=', 'titles.id')
                     ->where(function($query) {
                         $query->where('videos.episode', 1)
                               ->orWhere('videos.episode', 0);
                     });
            })
            ->where('titles.status', 1)
            ->orderBy('titles.created_at','DESC')
            ->get();
            
        if(isset($token) &&  !empty($key) && !empty($title)) {
           $keyword = DB::table('keywords')->where('title', $title)->first();
           if(!$keyword){
               $keyword = false;
           }
        }
        if($keyword){
            foreach($movies as $movie){
                $converd_keyword_id = unserialize($movie->keyword_id);
                $keywordId = $keyword->id;
                if (is_array($converd_keyword_id) && in_array($keywordId, $converd_keyword_id)) {
                    $data['movies'][] = $movie;
                }
            }
        }
        if(!empty($data['movies'])){
            return view('front.keyword', compact('session', 'data'));
        }else{
            return view('error_pages.errors');
        }
    }

}
