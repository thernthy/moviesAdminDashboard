<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class AuthController extends Controller
{
    public function index()
    {
        set_time_limit(0);
        libxml_use_internal_errors(true);  
        $url="https://drtv66.com/bbs/board.php?bo_table=movie&page=11";  
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
        
             $domvideo = new \DOMDocument('1.0', 'UTF-8'); 
             $domvideo->loadHTMLFile($hrefs[$i]); 
         
             // Create a new DOMXPath instance 
             $v_xpath = new \DOMXPath($domvideo); 
             $imgclass = "movie_poster";    
            $v_className = 'type11'; 
            $titleClass ="view-wrap"; 
            $decClass ="view-content"; 
         
            // Query all elements with the specified class name  
            $v_elements = $v_xpath->query("//*[contains(@class, '$v_className')]");  
            $img_elements = $v_xpath->query("//*[contains(@class, '$imgclass')]"); 
            $title_elements = $v_xpath->query("//*[contains(@class,'$titleClass')]");
            
            
            $dec_elements = $v_xpath->query("//*[contains(@class,'$decClass')]"); 
            $v_links = $v_elements[0]->getElementsByTagName('a'); 
            $src = $img_elements[0]->getElementsByTagName('img'); 
            $title = $title_elements[0]->getElementsByTagName('h1'); 
            echo "<br>";
            echo $i;
            echo $title[0]->textContent;
            echo "<br>";
            echo $dec_elements[1]->textContent;
            echo "<br>";
            echo "https://drtv66.com".$src[0]->getAttribute("src");
            echo "<br>";
            
            $insertTitle = DB::table('titles')
            ->insert([
                "movie_category_id" => 7,
                "title" => $title[0]->textContent,
                "movei_cover_path" => "https://drtv66.com".$src[0]->getAttribute("src"),
                "description" => $dec_elements[1]->textContent,
                "actors_id" => 7,
                "created_at" => $today
            ]);
            // $movie = new Title();
            // $movie->title = $title[0]->textContent;
            // $movie->movie_category_id = 7;
            // $movie->movei_cover_path = "https://drtv66.com".$src[0]->getAttribute("src");
            // $movie->description = $dec_elements[1]->textContent;
            // $movie->actors_id = 7;
            // $movie->created_at = $today;
            // $movie->save();
            $all_vd ="";
            for($j=0 ;$j<count($v_links); $j++)
            {
                
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
                 
                // print_r($array);
                 $finalArray = array();
                 foreach( $array as $val ){
                    
                    $tmp = explode( '|', $val );
                    //echo $tmp;
                    $finalArray[ $tmp[0] ] = $tmp[1]; 
                   
                    }
                    
                    $arr=[
                        "title_id"=>$movie->id,
                        "link"=>json_encode($finalArray),
                        "duration"=>"00:00:00",
                        "created_at"=>$today
                    ];                                            
                    $order_id = DB::table('videos')->insertGetId($arr);
                    echo "data has been save";
        }
    }
    }
   
}
