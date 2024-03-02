<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CRUDBooster;
use DateTime;
class AdminLinkScraperController extends \crocodicstudio\crudbooster\controllers\CBController
{
    public function getIndex() {
        return view('custom_adminn_view.data_scrapper_view');
    }
    public function view(Request $request){
        $category = DB::table('movie_category')->get();
        $arronepage = array();
        $arr = array();
        set_time_limit(0);
        libxml_use_internal_errors(true);  
        $url=$request->url;  
        $message = true;
        // Create a new DOMDocument instance  
        $dom = new \DOMDocument('1.0', 'UTF-8'); 
        date_default_timezone_set("Asia/Phnom_Penh");
        $today = Date('Y-m-d H:i:s'); 
        // Load the HTML content from the URL 
        $dom->loadHTMLFile($url);
        // Create a new DOMXPath instance  
        $xpath = new \DOMXPath($dom);  
        // Specify the class name of the elements you want to target  
        $className = 'list-container';  
        // Query all elements with the specified class name  
        $elements = $xpath->query("//*[contains(@class, '$className')]");  
        // Loop through each element and find links within them  
        $hrefs=array(); 
        $asArr = array();
        foreach ($elements as $element) {  
            // Find anchor elements within the current element  
            $links = $element->getElementsByTagName('a');  
            // Loop through each anchor element and extract the href attribute
            for($i = 0; $i<(count($links)-1); $i++){ 
                if($links[$i]->getAttribute('href') == $links[$i+1]->getAttribute('href')){ 
                        array_push($hrefs,$links[$i+1]->getAttribute('href')); 
                }
            }
            for($i = 0; $i<count($hrefs); $i++){ 
                $arronemovie = array();
                $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
                $domvideo->loadHTMLFile($hrefs[$i]); 
                $v_xpath = new \DOMXPath($domvideo); 
                $imgclass = "movie_poster";    
                $v_className = 'type11'; 
                $titleClass ="view-wrap"; 
                $decClass ="view-content"; 
                $v_elements = $v_xpath->query("//*[contains(@class, '$v_className')]");  
                $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]"); 
                $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
                $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]"); 
                $v_links = $v_elements[0]->getElementsByTagName('a'); 
                $src = $img_elements[0]->getElementsByTagName('img'); 
                $title = $title_elements[0]->getElementsByTagName('h1'); 
                /*$movie = DB::table('titles_ts')->insertGetId([
                    'title' => $title[0]->textContent,
                    'movie_category_id' => 7,
                    'movei_cover_path' => "https://drtv66.com".$src[0]->getAttribute("src"),
                    'description' => $dec_elements[1]->textContent,
                    'actors_id' => 7,
                    'created_at' => $today,
                ]);*/
                $all_vd ="";
                for($j=0 ;$j<count($v_links); $j++){
                    if($j==0){
                        if(preg_match('/\s/',$v_links[0]->textContent)){
                            if(str_contains($v_links[0]->getAttribute('href'),'https://rubystm.com/')){
                                $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".str_replace('https://rubystm.com/', 'https://rubystm.com/embed-',$v_links[0]->getAttribute('href')); 
                            }elseif(str_contains($v_links[0]->getAttribute('href'),'https://lylxan.com/')){
                               
                                $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".str_replace('https://lylxan.com/', 'https://lylxan.com/e/',$v_links[0]->getAttribute('href'));
                            }else{
                                $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".$v_links[0]->getAttribute('href'); 
                            }
                            
                        }else{
                            
                            if(str_contains($v_links[0]->getAttribute('href'),'https://rubystm.com/')){
                                $all_vd.= $v_links[0]->textContent."|".str_replace('https://rubystm.com/', 'https://rubystm.com/embed-',$v_links[0]->getAttribute('href')); 
                            }elseif(str_contains($v_links[0]->getAttribute('href'),'https://lylxan.com/')){
                               
                                $all_vd.= $v_links[0]->textContent."|".str_replace('https://lylxan.com/', 'https://lylxan.com/e/',$v_links[0]->getAttribute('href'));
                            }else{
                                $all_vd.= $v_links[0]->textContent."|".$v_links[0]->getAttribute('href'); 
                            }
                        }
                        
                    }
    
                    else if($j>0){
                        $all_vd.=",";
                        if(preg_match('/\s/',$v_links[$j]->textContent)){
                            //$all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".$v_links[$j]->getAttribute('href');
                            if(str_contains($v_links[$j]->getAttribute('href'),'https://rubystm.com/')){
                                $all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".str_replace('https://rubystm.com/', 'https://rubystm.com/embed-',$v_links[$j]->getAttribute('href')); 
                            }elseif(str_contains($v_links[$j]->getAttribute('href'),'https://lylxan.com/')){                           
                                $all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".str_replace('https://lylxan.com/', 'https://lylxan.com/e/',$v_links[$j]->getAttribute('href'));
                            }else{
                                $all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".$v_links[$j]->getAttribute('href'); 
                            } 
                        }else{
                           // $all_vd.= $v_links[$j]->textContent."|".$v_links[$j]->getAttribute('href');
                           if(str_contains($v_links[$j]->getAttribute('href'),'https://rubystm.com/')){
                                $all_vd.= $v_links[$j]->textContent."|".str_replace('https://rubystm.com/', 'https://rubystm.com/embed-',$v_links[$j]->getAttribute('href')); 
                            }elseif(str_contains($v_links[$j]->getAttribute('href'),'https://lylxan.com/')){                           
                                $all_vd.= $v_links[$j]->textContent."|".str_replace('https://lylxan.com/', 'https://lylxan.com/e/',$v_links[$j]->getAttribute('href'));
                            }else{
                                $all_vd.= $v_links[$j]->textContent."|".$v_links[$j]->getAttribute('href'); 
                            }
                        }
                    }
                }
                $array = explode(',',$all_vd);
                $finalArray = array();
                $episode = 0;
                foreach( $array as $val ){
                    $tmp = explode( '|', $val );
                    $finalArray[ $tmp[0] ] = $tmp[1]; 
                }
                /*$arr=[
                    "title_id"=>$movie,
                    "link"=>json_encode($finalArray),
                    "episode" => $episode,
                    "duration"=>"00:00:00",
                    "created_at"=>$today
                ];                                            
                $order_id = DB::table('videos_ts')->insertGetId($arr);
                if($order_id && $movie){
                    $message = true;
                }*/
                array_push($arronemovie, $title[0]->textContent,"https://drtv66.com".$src[0]->getAttribute("src"),$dec_elements[1]->textContent,json_encode($finalArray));
                array_push($arronepage,$arronemovie);  
            }
        }
        if($message){
            return response()->json(['success' => $message, "element"=> $arronepage, "category"=>$category]);
        }
    }
    
    
    public function savedata(Request $request){
        $saveData = $request->selectedData;
        $success = false;
        $episode = 0;
        foreach($saveData as $item){
            $movietitleSave = DB::table('titles_ts')->insertGetId([
                'title' => $item['text'],
                'movie_category_id' => intval($item['selectedOption']),
                'movei_cover_path' => $item['imgSrc'],
                'description' => $item['decr'],
                'actors_id' => 11,
            ]);
            $arr=[
                "title_id"=>$movietitleSave,
                "link"=>json_encode($item['links']),
                "episode" => $episode,
                "duration"=>"00:00:00",
            ];                                            
            $order_id = DB::table('videos_ts')->insertGetId($arr);
        }
        return response()->json(['datasend'=> $saveData]);
    }

   
}