<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use CRUDBooster;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Amp\Loop;
use Amp\Promise;
class AdminComicDataScrapperController extends \crocodicstudio\crudbooster\controllers\CBController
{

    public function getIndex() {
        return view('custom_adminn_view.comic_poster_board', compact('data'));
    }
    

    public function dosearch(Request $request)
    {
        $url = $request->url;
        set_time_limit(0);
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $msn = file_get_contents($url);
        $dom->loadHTML($msn);
        $xpath = new \DOMXPath($dom); 
        $elementClass = 'mx-n2'; 
        $linksD = array();
        $arrMovie = array();
        $arrImg = array();
        $elements = $xpath->query("//*[contains(@class, '$elementClass')]");
        $li = $elements[0]->getElementsByTagName('li');
        
        foreach($li as $l){
            array_push($linksD,$l->getElementsByTagName('a')[0]->getAttribute('href'));
            array_push($arrImg,$l->getElementsByTagName('img')[0]->getAttribute('src'));
        }
        
        for($i = 0; $i<count($linksD) ; $i++){
            
            $domT = new \DOMDocument('1.0', 'UTF-8');
            $chT = curl_init($linksD[$i]);
            curl_setopt($chT, CURLOPT_RETURNTRANSFER, true);
            $dataT = curl_exec($chT);
            $http_codeT = curl_getinfo($chT, CURLINFO_HTTP_CODE);
            curl_close($chT);
            $domT->loadHTML($dataT);
            if ($http_codeT == 200) {
            $xpathT = new \DOMXPath($domT);
            $imageClass = "zoom_image";
            $titleClass = "view-content";
            $decClass = "view-content1";
            $episodeClass = "na-subject";

           
            $title = $xpathT->query("//*[contains(@class, '$titleClass')]")[0]->getElementsByTagName('h1')[0]->textContent;
            $des = $xpathT->query("//*[contains(@class, '$decClass')]")[1]->textContent;
            $episodeLinks = $xpathT->query("//*[contains(@class, '$episodeClass')]");
            $imgT = $arrImg[$i];
            $arrayoneMovie = array();
            $linkspermovie = array();
            if($episodeLinks->length <= 0){
                $arrayoneMovie = array();
            }else{
                foreach($episodeLinks as $link){
                    array_push($linkspermovie,$link->getAttribute('href'));
                }
                if(count($linkspermovie)>0){
                    $revers = array_reverse($linkspermovie);
                    array_push($arrayoneMovie,$title,$imgT,$des,count($linkspermovie),json_encode($revers));
                }
            }
        } 
            
            array_push($arrMovie,$arrayoneMovie);
        }
        return view('custom_adminn_view.view_res_comic_dd', compact('arrMovie','url')); 
    }
    
    private static function RemoveSpecialChar($str) {
 
        // Using str_replace() function 
        // to replace the word 
        $res = str_replace( array( '\'', '"',
        ',' , ';', '<', '>','[',']',':','+','-','=',' ' ), '', $str);
   
        // Returning the result 
        return $res;
    }
        
    public function dosave(Request $r){
date_default_timezone_set("Asia/Phnom_Penh");
$today = date('Y-m-d H:i:s');
$arrTitle = [];
$arrImg = [];
$arrDes = [];
$arrEp = [];
$arrUrl = [];

for ($i = 0; $i < count($r->checkbox); $i++) {
    $title = "title" . $r->checkbox[$i];
    $img = "img" . $r->checkbox[$i];
    $des = "des" . $r->checkbox[$i];
    $ep = "ep" . $r->checkbox[$i];
    $url = "url" . $r->checkbox[$i];
    array_push($arrTitle, $r->$title);
    array_push($arrImg, $r->$img);
    array_push($arrDes, $r->$des);
    array_push($arrEp, $r->$ep);
    array_push($arrUrl, $r->$url);
}

if (count($arrTitle) > 0) {
    for ($t = 0; $t < count($arrTitle); $t++) {
        $data = DB::table('comic_tb_titles')
            ->where('title', $arrTitle[$t])
            ->first();
        if ($data == null) {
            $imageUrl = $arrImg[$t];
            $imagePath = "";
            if (str_contains($arrTitle[$t], ":") || str_contains($arrTitle[$t], " ") || str_contains($arrTitle[$t], "-") || str_contains($arrTitle[$t], "+")) {
                $imagePath = 'uploads/comic/' . self::RemoveSpecialChar($arrTitle[$t]) . '/';
            } else {
                $imagePath = 'uploads/comic/' . $arrTitle[$t] . '/';
            }

            // Fetch image data from the URL
            $imageData = file_get_contents($imageUrl);
            $imgT = "";
            if ($imageData !== false) {
                // Generate a unique filename for the image
                $filename = uniqid() . '_' . basename($imageUrl);
                $imgT = $imagePath . $filename;

                // Save the image to storage
                Storage::put($imagePath . $filename, $imageData);
            }

            $title_saved = DB::table('comic_tb_titles')->insertGetId([
                'title' => $arrTitle[$t],
                'comic_category_id' => 1,
                'photo_cover_path' => $imgT,
                'comic_dcr' => $arrDes[$t],
                'optional' => '',
                'comic_status' => 1
            ]);

            $arrayUr = json_decode($arrUrl[$t], true);
            for ($a = 0; $a < count($arrayUr); $a++) {
                set_time_limit(0);
                libxml_use_internal_errors(true);
                $path = $imagePath . ($a + 1) . '/';
                $arrImgPerEp = [];
                $domR = new \DOMDocument('1.0', 'UTF-8');
                $max_attempts = 3;
                $attempt = 0;

                do {
                    $domR = new \DOMDocument();
                    $result = @$domR->loadHTMLFile($arrayUr[$a]);
                    $attempt++;
                } while (!$result && $attempt < $max_attempts);

                if ($result) {
                    $xpathR = new \DOMXPath($domR);
                    $imgC = 'view-content';
                    $img_elements = $xpathR->query("//*[contains(@class, '$imgC')]")[0]->getElementsByTagName('img');
                    foreach ($img_elements as $im) {
                        if (str_contains($im->getAttribute('src'), 'http')) {
                            $imgUrl = $im->getAttribute('src');
                        } else {
                            $imgUrl = 'https://joatoon21.com' . $im->getAttribute('src');
                        }

                        $ch = curl_init($imgUrl);
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $data = curl_exec($ch);
                        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                        curl_close($ch);

                        if ($http_code == 200) {
                            $filenameI = uniqid() . '_' . basename($imgUrl);
                            $imgE = $path . $filenameI;
                            // Save the image to storage
                            Storage::put($path . $filenameI, $data);
                            array_push($arrImgPerEp, $imgE);
                        }
                    }
                }

                DB::table('comic_tb_ep')->insert([
                    'comic_title_id' => $title_saved,
                    'comic_img_path' => json_encode($arrImgPerEp),
                    'comic_ep' => $a + 1,
                    'comic_status' => 1,
                ]);
            }
        } else {
            $epindb =  DB::table('comic_tb_ep')
                ->where('comic_title_id', $data->id)
                ->get();
            $imagePath = "";
            if (str_contains($arrTitle[$t], ":") || str_contains($arrTitle[$t], " ") || str_contains($arrTitle[$t], "-") || str_contains($arrTitle[$t], "+")) {
                $imagePath = 'uploads/comic/' . self::RemoveSpecialChar($arrTitle[$t]) . '/';
            } else {
                $imagePath = 'uploads/comic/' . $arrTitle[$t] . '/';
            }
            if (count($epindb) == $arrEp[$t]) {
                // Do nothing if the number of episodes in the database matches the expected count
            } else {
                $arrayUr = json_decode($arrUrl[$t], true);
                for ($a = count($epindb); $a < count($arrayUr); $a++) {
                    set_time_limit(0);
                    libxml_use_internal_errors(true);
                    $path = $imagePath . ($a + 1) . '/';
                    $arrImgPerEp = [];
                    $domR = new \DOMDocument('1.0', 'UTF-8');
                    $max_attempts = 3;
                    $attempt = 0;

                    do {
                        $domR = new \DOMDocument();
                        $result = @$domR->loadHTMLFile($arrayUr[$a]);
                        $attempt++;
                    } while (!$result && $attempt < $max_attempts);

                    if ($result) {
                        $xpathR = new \DOMXPath($domR);
                        $imgC = 'view-content';
                        $img_elements = $xpathR->query("//*[contains(@class, '$imgC')]")[0]->getElementsByTagName('img');
                        foreach ($img_elements as $im) {
                            if (str_contains($im->getAttribute('src'), 'http')) {
                                $imgUrl = $im->getAttribute('src');
                            } else {
                                $imgUrl = 'https://joatoon21.com' . $im->getAttribute('src');
                            }

                            $ch = curl_init($imgUrl);
                            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                            $data = curl_exec($ch);
                            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                            curl_close($ch);

                            if ($http_code == 200) {
                                // Generate a unique filename for the image
                                $filenameI = uniqid() . '_' . basename($imgUrl);
                                $imgE = $path . $filenameI;
                                // Save the image to storage
                                Storage::put($path . $filenameI, $data);
                                array_push($arrImgPerEp, $imgE);
                            }
                        }
                    }

                    DB::table('comic_tb_ep')->insert([
                        'comic_title_id' => $data->id,
                        'comic_img_path' => json_encode($arrImgPerEp),
                        'comic_ep' => ($a + 1),
                        'comic_status' => 1,
                    ]);
                }
            }
        }
    }
}
        return redirect()->back()->with('msg', 'The Message');
    }

}