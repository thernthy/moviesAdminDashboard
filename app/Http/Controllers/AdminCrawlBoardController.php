<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CRUDBooster;
use DateTime;
class AdminCrawlBoardController extends \crocodicstudio\crudbooster\controllers\CBController
{
    public function cbInit()
    {
        $this->table = "crawl_boards";
        $this->title_field = "title";
        $this->limit = 10;
        $this->orderby = ["id" => "DESC"];
        $this->columns = ["title" => "Title", "created_at" => "Created At"];
        $this->form[] = [
            'label' => 'Date Of Birth', // Corrected label
            'name' => 'date_of_birth', // Corrected field name
            'type' => 'date',
            'validation' => 'required|date',
            'width' => 'col-sm-10'
        ];
        $this->style_css = "
                    .input-group.siteNamelist > ul {
                        display: flex;
                        align-items: center;
                        justify-content: center;
                    }
                ";

    
    }

    public function getIndex() {
        // You can pass any necessary data to your view here
        $data = []; // Define $data or retrieve necessary data
        $data['categorymovies'] = DB::table('movie_category')
        ->get();
        $data['siteList'] = DB::table('site_management')->select('name as site')->get();
        return view('custom_adminn_view.crawler_board', compact('data'));
    }
    
    
    public function BoardCrawler(Request $request) {
        $filerDate = $request->input('dateFile', '');
        $dateTime = DateTime::createFromFormat('m/d/Y', $filerDate);
        if ($dateTime !== false) {
            $dateformating = $dateTime->format('Y-m-d');
        } else {
            $dateformating = null; 
        }
        $siteName = $request->input('siteName', []);
        $movieCategory = $request->input('cateroymovies', '');
        $data = [];
        $movies = DB::table('movie_category')
            ->join('titles', 'titles.movie_category_id', 'movie_category.id')
            ->join('videos', 'videos.title_id', 'titles.id')
            ->where('movie_category.id', $movieCategory)
            ->where('videos.created_at',"LIKE","%$dateformating%") 
            ->get();
        $siteList = [];
        foreach($siteName as $site){
                $siteList[] = DB::table('site_management')
                ->where('name', $site)
                ->get();
        }
        
        if(!empty($siteList)){
           $data = [$siteList, $movies];
           if(!empty($movies)){
            return response()->json(['success' => true, 'data' => $data]);
           }else{
               return response()->json(['notFound' => true, 'data' => $data]);
           }
        }else{
           return response()->json(['notFound' => true, 'data' => $data]);
        }
    }

}
