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
        $dom = new \DOMDocument('1.0', 'UTF-8'); 
        date_default_timezone_set("Asia/Phnom_Penh");
        $today = Date('Y-m-d H:i:s'); 
        $dom->loadHTMLFile($url);
        $xpath = new \DOMXPath($dom);  
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
            for($i = 0; $i < count($hrefs); $i++){ 
                $arronemovie = array();
                $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
                $domvideo->loadHTMLFile($hrefs[$i]); 
                $v_xpath = new \DOMXPath($domvideo); 
                $imgclass = "movie_poster";    
                $v_className = 'type11'; 
                $titleClass ="view-wrap"; 
                $decClass ="view-content"; 
                $v_elements = $v_xpath->query("//*[contains(@class, '$v_className')]"); 
                if(count($v_elements)>0){ //==============if element url is dramar not drama 
                $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]"); 
                $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
                $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]"); 
                $src = $img_elements[0]->getElementsByTagName('img'); 
                $title = $title_elements[0]->getElementsByTagName('h1'); 
                $v_links = $v_elements[0]->getElementsByTagName('a'); 
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
                        
                    }else if($j>0){
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
                array_push($arronemovie, $title[0]->textContent,"https://drtv66.com".$src[0]->getAttribute("src"),$dec_elements[1]->textContent,json_encode($finalArray));
                array_push($arronepage,$arronemovie);
                
                }else{//===================if dramar this code will run
                    $finalArray = array();
                    $stringimg = "https://drtv66.com/img/no_img2.png";
                    $decClass ="movie_info";
                    $v_className ='view-content';
                    $v_elements = $v_xpath->query("//*[contains(@class, '$decClass')]"); 
                    $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]");  
                    $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]"); 
                    $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]");
                    $v_links = $v_elements[1]->getElementsByTagName('a');  
                    $linkV = ""; 
                    $desV =""; 
                    if($img_elements->length <= 0){ 
                        $src = array(); 
                    }else{ 
                        $src = $img_elements[0]->getElementsByTagName('img'); 
                    }
                    
                    //loop linke and converd to string 
                    if($v_links->length <= 0){ 
                        $v_links = $dec_elements[0]->getElementsByTagName('a');
                        $all_vd ="";
                        for($j=0 ;$j<count($v_links); $j++)
                        {
                            if($j==0){
                                if(preg_match('/\s/',$v_links[0]->textContent)){
                                    $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".$v_links[0]->getAttribute('href'); 
                                }else{
                                    $all_vd.= $v_links[0]->textContent."|".$v_links[0]->getAttribute('href'); 
                                }
                            } else if($j>0){
                                $all_vd.=",";
                                if(preg_match('/\s/',$v_links[$j]->textContent)){
                                    $all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".$v_links[$j]->getAttribute('href'); 
                                }else{
                                   $all_vd.= $v_links[$j]->textContent."|".$v_links[$j]->getAttribute('href');
                                }
                            }
                        }
                        //after cover to string make it ask array
                        $array = explode(',',$all_vd);
                        foreach( $array as $val ){
                            $tmp = explode( '|', $val );
                            $finalArray[ $tmp[0] ] = $tmp[1]; 
                        }
                    }else{ 
                        $all_vd ="";
                        for($j=0 ;$j<count($v_links); $j++)
                        {
                            if($j==0){
                                if(preg_match('/\s/',$v_links[0]->textContent)){
                                $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".$v_links[0]->getAttribute('href'); 
                                }else{
                                    $all_vd.= $v_links[0]->textContent."|".$v_links[0]->getAttribute('href'); 
                                }
                                } else if($j>0){
                                    $all_vd.=",";
                                if(preg_match('/\s/',$v_links[$j]->textContent)){
                                    $all_vd.=str_replace(' ', '', $v_links[$j]->textContent)."|".$v_links[$j]->getAttribute('href'); 
                                }else{
                                   $all_vd.= $v_links[$j]->textContent."|".$v_links[$j]->getAttribute('href');
                                }
                            }
                        }
                        $array = explode(',',$all_vd);
                        foreach( $array as $val ){
                           $tmp = explode( '|', $val );
                           $finalArray[ $tmp[0] ] = $tmp[1]; 
                        }
                        $desV = $dec_elements[0]->textContent;  
                    } 
                 
                    $title = $title_elements[0]->getElementsByTagName('h1'); 
                    $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");           
                    $title_v = array();   
                    $string = $title[0]->textContent; 
                    $pattern = '[[\d]+회]'; //check titile has this text "회"
                    $srcImg=""; 
                    $countImg =  count($src); 
                    preg_match($pattern, $string, $matches); 
                    
                    if (!empty($matches)) { 
                        foreach($matches as $m){ 
                            $title_v = explode($m, $string); 
                        } 
                    } 
                    
                    //check image element founding or not
                    if($countImg == 0){ 
                        $srcImg = $stringimg; 
                    }else{ 
                        $srcImg = $src[0]->getAttribute("src"); 
                    } 
                    
                    //push array by this structure 
                    array_push($arronemovie, $title_v[0],$srcImg,$desV,json_encode($finalArray)); 
                    //final push all data by every time loop to $arronepage
                    array_push($arronepage,$arronemovie); 
                }

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
        $today = Date('Y-m-d H:i:s');
        //loop data RQS insert  
        foreach($saveData as $item){
            //check if select category is dramar && TV show 
            if (intval($item['selectedOption']) == 1 || intval($item['selectedOption']) == 3) {
                $dataSavedMovie = DB::table('titles')->where('title', $item['text'])->first();
                //check movie titile has or not
                if (!$dataSavedMovie) {
                    //title is no on db insert title && videos link
                    $arrm=[
                        'title'             =>  $item['text'],
                        'movie_category_id' =>  intval($item['selectedOption']),                    
                        'movei_cover_path'  =>  $item['imgSrc'],
                        'description'       =>  $item['decr'],                    
                        'actors_id'         =>  11,
                        'status'            =>  1,
                        'created_at'        =>  $today 
                    ];
                    $movie = DB::table('titles')->insertGetId($arrm);
                    $arr=[
                        "title_id"   => $movie,
                        "link"       => (is_array($item['links'])) ? json_encode($item['links']):$item['links'],//check is link is array it will insert as array opjects
                        "duration"   => "00:00:00",
                        "episode"    => 1,
                        "created_at" => $today
                    ];
                    $order_id = DB::table('videos')->insertGetId($arr);
                    
                }else{
                    
                    //if has just add video link to videos
                    $videoSaved = DB::table('videos')
                    ->where('title_id', $dataSavedMovie->id)
                    ->latest('id')
                    ->first();
                    $arr=[
                        "title_id"    =>    $dataSavedMovie->id,
                        "link"        =>    (is_array($item['links'])) ? json_encode($item['links']):$item['links'],//check is link is array it will insert as array opjects
                        "duration"    =>    "00:00:00",
                        "episode"     =>    $videoSaved->episode+1,
                        "created_at"  =>  $today
                    ]; 
                    $order_id = DB::table('videos')->insertGetId($arr);  
                }
                
            }else{
                
                $movietitleSave = DB::table('titles')->insertGetId([
                    'movie_category_id' => intval($item['selectedOption']),
                    'title'             => $item['text'],
                    'movei_cover_path'  => $item['imgSrc'],
                    'description'       => $item['decr'],
                    'actors_id'         => 11,
                    'status'            => 1,
                    'created_at'        => $today
                ]);
                $arr=[
                    "title_id"    => $movietitleSave,
                    "link"        => json_encode($item['links']),
                    "episode"     => $episode,
                    "duration"    => "00:00:00",
                    "created_at"  => $today
                ];                                            
                $order_id = DB::table('videos')->insertGetId($arr);
            }
        }
        
        //respone user after insert 
        return response()->json(['datasend'=> $saveData]);
        
    }
    
    //auto running uploading post 
    
    /*function AutoUpadteMovies(){
        $url = "https://drtv66.com/";
        
        
    }*/
    
}