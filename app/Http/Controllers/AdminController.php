<?php
namespace App\Http\Controllers;
use CRUDBooster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller
{
    public function changeLanguage(Request $request)
    {
        $language = $request->input('language');
        Session::put('locale', $language);
        return redirect()->back();
    }
    
    public function autoPost(Request $request){
        try {
            $url = 'https://drtv66.com/';
            $keywords_movice = ['4','16','17'];
            $keywords_drama = ['4','20','21'];
            $keywords_ent = ['4','18','19'];
            $arronepageM = array();
            $arronepageD = array();
            $arronepageE = array();
            $arr = array();
            set_time_limit(0);
            libxml_use_internal_errors(true);  
            //$url=$url;  
            $message = true;
            $dom = new \DOMDocument('1.0', 'UTF-8'); 
            date_default_timezone_set("Asia/Phnom_Penh");
            $today = Date('Y-m-d H:i:s'); 
            $dom->loadHTMLFile($url);
            $xpath = new \DOMXPath($dom);  
            $className = 'main_link_div';  
            // Query all elements with the specified class name  
            $elements = $xpath->query("//*[contains(@class, '$className')]"); 
            // Loop through each element and find links within them  
            $hrefM=array(); 
            $hrefD=array();
            $hrefE=array(); 
            $asArr = array();
            for($i = 0 ; $i < (count($elements)-1); $i++) {  
            // Find anchor elements within the current element  
            $linksM = array();
            $linksD = array();
            $linksE = array();
            for ($i = 0; $i < (count($elements) - 1); $i++) {
                // Find anchor elements within the current element
                if ($i == 0) {
                    $linksM = $elements[0]->getElementsByTagName('a');
                } elseif ($i == 1) {
                    $domD = new \DOMDocument('1.0', 'UTF-8'); 
                    $urlD = "https://drtv66.com/bbs/board.php?bo_table=drama"; 
                    $domD->loadHTMLFile($urlD); 
                    $xpathD = new \DOMXPath($domD);   
                    $classNameD = 'list-container'; 
                    $elementsD = $xpathD->query("//*[contains(@class, '$classNameD')]"); 
                    $linksD = $elementsD[0]->getElementsByTagName('a'); 
                } elseif ($i == 2) {
                    $linksE = $elements[2]->getElementsByTagName('a');
                }
            }
              
            // Loop through each anchor element and extract the href attribute
            for($i = 0; $i<(count($linksM)-1); $i++){ 
                if($linksM[$i]->getAttribute('href') == $linksM[$i+1]->getAttribute('href')){ 
                        array_push($hrefM,$linksM[$i+1]->getAttribute('href')); 
                }
            }            
            for($j = 0; $j<(count($linksD)-1); $j++){ 
                if($linksD[$j]->getAttribute('href') == $linksD[$j+1]->getAttribute('href')){ 
                        array_push($hrefD,$linksD[$j+1]->getAttribute('href')); 
                }
            }
            for($i = 0; $i<(count($linksE)-1); $i++){ 
                if($linksE[$i]->getAttribute('href') == $linksE[$i+1]->getAttribute('href')){ 
                        array_push($hrefE,$linksE[$i+1]->getAttribute('href')); 
                }
            }
        }
            for($i = 0; $i<count($hrefM); $i++){ 
                $arronemovie = array();
                $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
                $domvideo->loadHTMLFile($hrefM[$i]); 
                $v_xpath = new \DOMXPath($domvideo); 
                $imgclass = "movie_poster";    
                $v_className = 'type11'; 
                $titleClass ="view-wrap"; 
                $decClass ="view-content"; 
                $v_elements = $v_xpath->query("//*[contains(@class, '$v_className')]"); 
                $dateClass = "pull-right";
                $postdate = $v_xpath->query("//*[contains(@class,'$dateClass')]");
                if(!str_contains($postdate[1]->textContent, '.')){ //==============if element url is dramar not drama 
                $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]"); 
                $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
                $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]"); 
                $src = $img_elements[0]->getElementsByTagName('img'); 
                $title = $title_elements[0]->getElementsByTagName('h1'); 
                $v_links = $v_elements[0]->getElementsByTagName('a'); 
                ;
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
                    $jsonString = json_encode($finalArray);
                            $data = json_decode($jsonString, true);
                            $resultArray = [];

                            // Iterate through the associative array
                            foreach ($data as $key => $value) {
                                // Create a new associative array with the current key and value
                                $resultArray[] = [$key => $value];
                            }

                            // Convert the result array to JSON format
                            $resultJson = json_encode($resultArray);
                array_push($arronemovie, $title[0]->textContent,"https://drtv66.com".$src[0]->getAttribute("src"),$dec_elements[1]->textContent,$resultJson);
                 
                array_push($arronepageM,$arronemovie);    
                }
        }
            /****************drama*/
            for($i = 0; $i<count($hrefD); $i++){ 
                    $arronemovie = array();
                    $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
                    $domvideo->loadHTMLFile($hrefD[$i]); 
                    $v_xpath = new \DOMXPath($domvideo); 
                    $imgclass = "movie_poster";
                    $titleClass ="view-wrap";
                    $linkclass ="view-content"; 
                    $decClass ="movie_info";
                    $v_elements = $v_xpath->query("//*[contains(@class, '$linkclass')]"); 
                    $dateClass = "pull-right";
                    $postdate = $v_xpath->query("//*[contains(@class,'$dateClass')]");
                    $stringimg = "https://drtv66.com/img/no_img2.png";
                    $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]");
                    $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]");
                    $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
                    $src=array(); 
                    if(!str_contains($postdate[1]->textContent, '.')){ //==============if element url is dramar not drama 
                            $finalArray = array();
                            $v_links = $v_elements[1]->getElementsByTagName('a');  
                            $linkV = ""; 
                            $desV =""; 
                            if($img_elements->length <= 0){ 
                                $src=array(); 
                            }else{ 
                                $src = $img_elements[0]->getElementsByTagName('img'); 
                            } 
                            if($v_links->length <= 0){         
                                $v_links = $dec_elements[0]->getElementsByTagName('a');
                                $all_vd ="";
                                for($j=0 ;$j<count($v_links); $j++){                
                                if($j==0){
                                    if(preg_match('/\s/',$v_links[0]->textContent)){
                                            $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".$v_links[0]->getAttribute('href'); 
                                        }else{
                                            $all_vd.= $v_links[0]->textContent."|".$v_links[0]->getAttribute('href'); 
                                            }
                                        }elseif($j>0){
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
                       
                        }
                        if($dec_elements->length <= 2){
                            $desV = "No description";
                        }else{
                            $desV = $dec_elements[0]->textContent;
                        }
                          
                                 
                            } 
                         
                            $title = $title_elements[0]->getElementsByTagName('h1'); 
                      
                            $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");           
                         
                            $title_v = array();   
                            $string = $title[0]->textContent; 
                            $pattern = '[[\d]+회]'; 
                            
                             
                            preg_match($pattern, $string, $matches); 
         
                            if (!empty($matches)) { 
                                foreach($matches as $m){ 
                                    $title_v = explode($m, $string); 
                                } 
                            }else{
                                $title_v[0] = $string;
                            } 
                            
                         
                           $srcImg=""; 
                            $countImg =  count($src); 
                            if($countImg ==0){ 
                                $srcImg = $stringimg; 
                            }else{ 
                                $srcImg = $src[0]->getAttribute("src"); 
                            }
                                $jsonString = json_encode($finalArray);
                                        $data = json_decode($jsonString, true);
                                        $resultArray = [];
        
                                        // Iterate through the associative array
                                        foreach ($data as $key => $value) {
                                            // Create a new associative array with the current key and value
                                            $resultArray[] = [$key => $value];
                                        }
        
                                        // Convert the result array to JSON format
                                        $resultJson = json_encode($resultArray);
                                      
                          array_push($arronemovie, $title_v[0],$srcImg,$desV,$resultJson);
                             
                          array_push($arronepageD,$arronemovie);  
                    
                }
            //print_r($arronepageD);
            /*************entertain */
            for($i = 0; $i<count($hrefE); $i++){ 
                $arronemovie = array();
                $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
                $domvideo->loadHTMLFile($hrefE[$i]); 
                $v_xpath = new \DOMXPath($domvideo); 
                $imgclass = "movie_poster";
                $titleClass ="view-wrap";
                $linkclass ="view-content"; 
                $decClass ="movie_info";
                $v_elements = $v_xpath->query("//*[contains(@class, '$linkclass')]"); 
                $dateClass = "pull-right";
                $postdate = $v_xpath->query("//*[contains(@class,'$dateClass')]");
                $stringimg = "https://drtv66.com/img/no_img2.png";
                $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]");
                $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]");
                $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
                $src=array();
                //print_r($dec_elements);
                if(str_contains($postdate[1]->textContent, '.')){ //==============if element url is dramar not drama 
                        $finalArray = array();
                        $v_links = $v_elements[1]->getElementsByTagName('a');  
                        $linkV = ""; 
                        $desV =""; 
                        if($img_elements->length <= 0){ 
                            $src=array(); 
                        }else{ 
                            $src = $img_elements[0]->getElementsByTagName('img'); 
                        } 
                        if($v_links->length <= 0){         
                            $v_links = $dec_elements[0]->getElementsByTagName('a');
                            $all_vd ="";
                            for($j=0 ;$j<count($v_links); $j++){                
                            if($j==0){
                                if(preg_match('/\s/',$v_links[0]->textContent)){
                                        $all_vd.=str_replace(' ', '', $v_links[0]->textContent)."|".$v_links[0]->getAttribute('href'); 
                                    }else{
                                        $all_vd.= $v_links[0]->textContent."|".$v_links[0]->getAttribute('href'); 
                                        }
                                    }elseif($j>0){
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
                //echo ($all_vd);
                foreach( $array as $val ){
                
                $tmp = explode( '|', $val );
                
                $finalArray[ $tmp[0] ] = $tmp[1]; 
                        }
                
                    }
                    if($dec_elements->length <= 2){
                        $desV = "No description";
                    }else{
                        $desV = $dec_elements[0]->textContent;
                    }  
                            
                        } 
                    
                        $title = $title_elements[0]->getElementsByTagName('h1'); 
                
                        $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");           
                    
                        $title_v = array();   
                        $string = $title[0]->textContent; 
                        $pattern = '[[\d]+회]'; 
                        
                        
                        preg_match($pattern, $string, $matches); 

                        if (!empty($matches)) { 
                            foreach($matches as $m){ 
                                $title_v = explode($m, $string); 
                            }
                        }else{
                            $title_v[0] = $string;
                        }  
                    
                    $srcImg=""; 
                        $countImg =  count($src); 
                        if($countImg ==0){ 
                            $srcImg = $stringimg; 
                        }else{ 
                            $srcImg = $src[0]->getAttribute("src"); 
                        }
                            $jsonString = json_encode($finalArray);
                                    $data = json_decode($jsonString, true);
                                    $resultArray = [];

                                    // Iterate through the associative array
                                    foreach ($data as $key => $value) {
                                        // Create a new associative array with the current key and value
                                        $resultArray[] = [$key => $value];
                                    }

                                    // Convert the result array to JSON format
                                    $resultJson = json_encode($resultArray);
                        array_push($arronemovie, $title_v[0],$srcImg,$desV,$resultJson);
                        
                        array_push($arronepageE,$arronemovie);  
                
            }
            /*******************Movie */
            if(count($arronepageM)>0){
            $arronepageM =array_reverse($arronepageM);
            for($i=0;$i<count($arronepageM);$i++){
            $data = DB::table('titles')
            ->where('title', $arronepageM[$i][0])
            ->first();
            if($data==null){
                $arrm=[
                    'title' => $arronepageM[$i][0],
                    'keyword_id' => serialize($keywords_movice),
                    'movie_category_id' => 7,                    
                    'movei_cover_path' => $arronepageM[$i][1],
                    'description' => $arronepageM[$i][2],                    
                    'actors_id' => 11,
                    'status' => 1,
                    'created_at' => $today 
                ];
                $movie = DB::table('titles')->insertGetId($arrm);  
                $arr=[
                    "title_id"=>$movie,
                    "link"=>$arronepageM[$i][3],
                    "episode" => '0',
                    "duration"=>"00:00:00",
                    "created_at"=>$today
                ];                                            
                $order_id = DB::table('videos')->insertGetId($arr);
                }
            }
            }
            if(count($arronepageD)>0){
            $arronepageD =array_reverse($arronepageD);
            for($i=0;$i<count($arronepageD);$i++){
                $data = DB::table('titles')
                ->where('title', $arronepageD[$i][0])
                ->first();
                if($data==null){
                $arrm=[
                    'title' => $arronepageD[$i][0],
                    'movie_category_id' => 1,                    
                    'movei_cover_path' => $arronepageD[$i][1],
                    'description' => $arronepageD[$i][2],  
                    'keyword_id' => serialize($keywords_drama),                                 
                    'actors_id' => 11,
                    'status' => 1,
                    'created_at' => $today 
                ];
                $movie = DB::table('titles')->insertGetId($arrm);  
                $arr=[
                    "title_id"=>$movie,
                    "link"=>$arronepageD[$i][3],
                    "duration"=>"00:00:00",
                    "episode" => 1,
                    "created_at"=>$today
                ];                                            
                $order_id = DB::table('videos')->insertGetId($arr);
                }else{
                $newvideo = DB::table('videos')
                ->where('title_id', $data->id)
                ->whereDate('created_at','like',Date('Y-m-d'))     
                ->get();
                $dbvideo = DB::table('videos')
                ->where('title_id', $data->id)
                ->latest('id')
                ->first();
                if(count($newvideo)==0){
                    $arr=[
                        "title_id"=>$data->id,
                        "link"=>$arronepageD[$i][3],
                        "duration"=>"00:00:00",
                        "episode" => $dbvideo->episode+1,
                        "created_at"=>$today
                    ];                                            
                    $order_id = DB::table('videos')->insertGetId($arr);
                }
                    else {
                        $existingVideo = $newvideo->where('link', $arronepageD[$i][3])->first();
                        if ($existingVideo) {
                            // If the video already exists, you may want to skip it or handle it differently
                            // You can add code here to perform any necessary actions
                        } else {
                            $latestVideo = DB::table('videos')
                                ->where('title_id', $data->id)
                                ->latest('id')
                                ->first();
                            $videoArr = [
                                "title_id" => $data->id,
                                "link" => $arronepageD[$i][3],
                                "duration" => "00:00:00",
                                "episode" => $latestVideo->episode + 1,
                                "created_at" => $today
                            ];
            
                            $orderId = DB::table('videos')->insertGetId($videoArr);
                        }
                    }
                }
            }
            }
            if(count($arronepageE)>0){
            $arronepageE =array_reverse($arronepageE);
            for($i=0;$i<count($arronepageE);$i++){
            $data = DB::table('titles')
            ->where('title', $arronepageE[$i][0])
            ->first();
            if($data==null){
            $arrm=[
                'title' => $arronepageE[$i][0],
                'movie_category_id' => 3,                    
                'movei_cover_path' => $arronepageE[$i][1],
                'description' => $arronepageE[$i][2],
                'keyword_id' => serialize($keywords_ent),                       
                'actors_id' => 11,
                'status' => 1,
                'created_at' => $today 
            ];
            $movie = DB::table('titles')->insertGetId($arrm);  
            $arr=[
                "title_id"=>$movie,
                "link"=>$arronepageE[$i][3],
                "duration"=>"00:00:00",
                "episode" => 1,
                "created_at"=>$today
            ];                                            
            $order_id = DB::table('videos')->insertGetId($arr);
            }else{
                $newvideo = DB::table('videos')
                ->where('title_id', $data->id)
                ->whereDate('created_at','like',Date('Y-m-d'))            
                ->get();
                $dbvideo = DB::table('videos')
                ->where('title_id', $data->id)
                ->latest('id')
                ->first();
                if(count($newvideo)==0){
                    $arr=[
                        "title_id"=>$data->id,
                        "link"=>$arronepageE[$i][3],
                        "duration"=>"00:00:00",
                        "episode" => $dbvideo->episode+1,
                        "created_at"=>$today
                    ];                                            
                    $order_id = DB::table('videos')->insertGetId($arr);
                }
                    else {
                        $existingVideo = $newvideo->where('link', $arronepageE[$i][3])->first();
            
                        if ($existingVideo) {
                            // If the video already exists, you may want to skip it or handle it differently
                            // You can add code here to perform any necessary actions
                        } else {
                            $latestVideo = DB::table('videos')
                                ->where('title_id', $data->id)
                                ->latest('id')
                                ->first();
            
                            $videoArr = [
                                "title_id" => $data->id,
                                "link" => $arronepageE[$i][3],
                                "duration" => "00:00:00",
                                "episode" => $latestVideo->episode + 1,
                                "created_at" => $today
                            ];
            
                            $orderId = DB::table('videos')->insertGetId($videoArr);
                        }
                    }
                }
            }
            }
            Log::info('Auto post completed successfully at: ' . now());
        }catch (\Exception $e) {
            Log::error('Error occurred while executing autoPost function: ' . $e->getMessage());
            Log::error($e->getTraceAsString());
        }
    }
}