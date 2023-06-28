<?php 

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function time_from_update($timestamp) {
    $act = time();
    $diff = $act - $timestamp;
    $arr_time = array('y'=>'y','mo'=>'m','d'=>'d','h'=>'hr','m'=>'min','s'=>'sec');
    $arr_mtime =  array('y'=>'y','mo'=>'m','d'=>'d','h'=>'hrs','m'=>'mins','s'=>'secs');

    $arr = array('y'=>31536000, 'mo'=>2678400, 'd'=>86400, 'h'=>3600, 'm'=>60, 's'=>1);
    $cnt = count($arr);
    $i = 1;
    foreach($arr as $key => $val) {
        if( ($val - $diff) <= 0 && $i < $cnt) {
            $tmp[$key] =  floor($diff / $val);
            $diff = $diff - (floor($diff / $val) * $val);
        }
        if($i == $cnt) {
            $tmp[$key] = $diff;
        }
    }

    if (!isset($tmp)) {
        return null;
    } elseif (count($tmp) > 1) {
        $first = array_values($tmp)[0] .' '. (array_values($tmp)[0] > 1?$arr_mtime[array_key_first($tmp)]:$arr_time[array_key_first($tmp)]);
        array_shift($tmp);
        $second = array_values($tmp)[0] .' '. (array_values($tmp)[0] > 1?$arr_mtime[array_key_first($tmp)]:$arr_time[array_key_first($tmp)]);
        return $first ." ". $second;
    } elseif (count($tmp) == 1) {
        return array_values($tmp)[0] .' '. (array_values($tmp)[0] > 1?$arr_mtime[array_key_first($tmp)]:$arr_time[array_key_first($tmp)]);
    }
}

function secondsToHms($seconds) {
    $seconds = (int)$seconds;
    $h = floor($seconds / 3600);
    $m = floor($seconds % 3600 / 60);
    $s = floor($seconds % 3600 % 60);

    $final_time = '';

    $final_time .= $h > 0 ? $h . "h" : "";
    if ($h > 0 && $m > 0) {
        $final_time .= ":";
    }
    $final_time .= $m > 0 ? $m . "m" : "";
    if ($m > 0 && $s > 0) {
        $final_time .= ":";
    }
    $final_time .= $s > 0 ? $s . "s" : "";
    return $final_time == ""?'0s' : $final_time;
}

//return number from pickerValue
function rgbToNum($rgb = "rgb(255,255,255)"){
    if(is_numeric($rgb)){
        return $rgb;
    }
    $rgb = substr(substr($rgb,4),0,-1);
    $rgb = explode(",",$rgb);
    $rgb = (int)$rgb[0]*1000000+(int)$rgb[1]*1000+(int)$rgb[2];
    // dd($rgb);
    return $rgb;

}

//if plain == true, return string able to paste in html, if false than returned as assoc array
function numToRGB($num = 255255255,$plain = true ){
    $b = $num%1000;
    $g = ($num/1000)%1000;
    $r = ($num/1000000)%1000;

    if($plain){
        return "rgb({$r},{$g},{$b})";
    }
    return ["r"=>$r,"g"=>$g,"b"=>$b];
}


function toast($title = "", $message = "", $type = 'success'){
    $ret = "";

    $tempID = generateRandomString(10);

    $ret .= 
    '<div class="toast mb-2" role="alert" aria-live="assertive" style="display:block;" aria-atomic="true">
        <div class="toast-header rounded-top d-flex bg-'.$type.'">
            <strong class="me-auto">'.$title.'</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="$(this).parent().parent().remove();"></button>
        </div>
        <div class="toast-body bg-'.$type.'-subtle">
            <strong class="me-auto">'.$message.'</strong>
        </div>
        <div class="bg-dark rotate-180">
        <div class="progress" style="height: 3px;">
            <div class="progress-bar bg-'.$type.'" role="progressbar" style="width: 0%;" id="'.$tempID.'"></div>
        </div>
        </div>
        <script>
        bar'.$tempID.' = "#'.$tempID.'";
            var progress'.$tempID.' = 0; 
                var interval'.$tempID.' = setInterval(function() {
                    progress'.$tempID.' += 3;
                    $(bar'.$tempID.').css("width", progress'.$tempID.' + "%");
                    if (progress'.$tempID.' >= 100) {
                        console.log($(bar'.$tempID.').parent().parent().parent());
                        $(bar'.$tempID.').parent().parent().parent().fadeOut(1000);
                        clearInterval(interval'.$tempID.');
                    }
                }, 100);


    </script>
    </div>
    ';

    return $ret;
}












// function getTimespan($name = null){
//     $timespan = array(
//         '1' => 'Last 24 hours',
//         '2' => 'Last 7 days',
//         '3' => 'Last 30 days',
//         '4' => 'Last 12 months',
//     );
//     if(isset($timespan[$name])){
//         return $timespan[$name];
//     } else if(isset(array_flip($timespan)[$name])){
//         return array_flip($timespan)[$name];
//     }
//     return $timespan;
// }


?>