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


function toast($message = null, $type = 'success'){
    $ret = "";

    $tempID = generateRandomString(10);

    $ret .= 
    // '<div class="position-fixed bottom-0 end-0 p-3">
    //     <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    //         <div class="toast-header">
    //             <span class="me-2 rounded d-inline-flex bg-danger" style="width:20px;height:20px;"></span>
    //             <strong class="me-auto">'.$title.'</strong>
    //             <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    //         </div>
    //         <div class="toast-body">
    //             '.$message.'
    //         </div>
    //     </div>
    // </div>';
    '<div class="toast mt-2" role="alert" aria-live="assertive" style="display:block;" aria-atomic="true">
        <div class="toast-body rounded-top d-flex bg-'.$type.'">
            <strong class="me-auto">'.$message.'</strong>
            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="$(this).parent().parent().remove();"></button>
        </div>
        <div class="bg-dark rotate-180">
        <div class="progress" style="height: 3px;">
            <div class="progress-bar bg-light" role="progressbar" style="width: 0%;" id="'.$tempID.'"></div>
        </div>
        </div>
    </div>
    <script>
        //progress(\''.$tempID.'\');

        bar'.$tempID.' = "#'.$tempID.'";
            var progress'.$tempID.' = 0; 
                var interval'.$tempID.' = setInterval(function() {
                    progress'.$tempID.' += 3;
                    $(bar'.$tempID.').css("width", progress'.$tempID.' + "%");
                    if (progress'.$tempID.' >= 100) {
                        console.log($(bar'.$tempID.').parent().parent().parent());
                        $(bar'.$tempID.').parent().parent().parent().fadeOut(1000);
                        // $(bar'.$tempID.').parent().parent().parent().remove();
                        clearInterval(interval'.$tempID.');
                    }
                }, 100);
    
    
    </script>
    ';

    return $ret;
}











//GETSETS






function getMetrics($name = null){
    $name = strtolower($name);
    $metrics = array(
        '0' => 'System',
        '1' => 'temperature',
        '2' => 'humidity',
        '3' => 'humidity_temperature',
        '4' => 'light'
    );
    if(isset($metrics[$name])){
        return $metrics[$name];
    } else if(isset(array_flip($metrics)[$name])){
        return array_flip($metrics)[$name];
    }
    return $metrics;
}

function getCharts($name = null){
    $charts = array(
        '1' => 'Line',
        '2' => 'Area',
        '3' => 'Bar',
    );
    if(isset($charts[$name])){
        return $charts[$name];
    } else if(isset(array_flip($charts)[$name])){
        return array_flip($charts)[$name];
    }
    return $charts;
}

function getUnits($name = null){
    $units = array(
        '0' => 'System',
        '1' => 'Empty',
        '2' => 'C',
        '3' => '%',
        '4' => 'Lux',
    );
    if(isset($units[$name])){
        return $units[$name];
    } else if(isset(array_flip($units)[$name])){
        return array_flip($units)[$name];
    }
    return $units;
}

function getChartTimeSpan($name = null){
    // $timespan = array(
    //     '1' => 'Day',
    //     '2' => 'Week',
    //     '3' => 'Month',
    //     '4' => 'Year',
    //     '5' => 'All',
    // );
    // "60"=>"Hour",
    //     "1440"=>"Day",
    //     "10080"=>"Week",
    //     "302400"=>"Month",
    //     "3628800"=>"Year",
    //     "0"=>"All",

    $timespan =[
        "1"=>"Last 10 Minutes",
        "2"=>"Last Hour",
        "3"=>"Last Day",
        "4"=>"Last Week",
        "5"=>"Last Month",
        "6"=>"All",

    ];
    if(isset($timespan[$name])){
        return $timespan[$name];
    } else if(isset(array_flip($timespan)[$name])){
        return array_flip($timespan)[$name];
    }
    return $timespan;
}

function getGranuality($name = null){
    $granuality =[
        "1"=>"Minute",
        "2"=>"Hourly",
        "3"=>"Daily",
        "4"=>"Monthly",
        "5"=>"Yearly",
        "6"=>"None",

    ];
    if(isset($granuality[$name])){
        return $granuality[$name];
    } else if(isset(array_flip($granuality)[$name])){
        return array_flip($granuality)[$name];
    }
    return $granuality;
}

function getAllowedGranuality($name = null){
    $granuality =[
        "1"=>"All_Minute_None",
        "2"=>"All_Minute_None",
        "3"=>"All_Minute_Hourly_None",
        "4"=>"All_Minute_Hourly_Daily_None",
        "5"=>"All_Minute_Hourly_Daily_None",
        "6"=>"All_Minute_Hourly_Daily_Monthly_Yearly_None",

    ];
    if(isset($granuality[$name])){
        return $granuality[$name];
    } else if(isset(array_flip($granuality)[$name])){
        return array_flip($granuality)[$name];
    }
    return $granuality;
}

function getDisplayShowMode($name = null){
    $displayShowMode =[
        "1"=>"hh:mm",
        "2"=>getMetrics(3),
        "3"=>getMetrics(2),
        "4"=>getMetrics(4),

    ];
    if(isset($displayShowMode[$name])){
        return $displayShowMode[$name];
    } else if(isset(array_flip($displayShowMode)[$name])){
        return array_flip($displayShowMode)[$name];
    }
    return $displayShowMode;
}

function getDisplayColorMode($name = null){
    $colorMode =[
        "1"=>"255255255",
        "2"=>"247071071",
        "3"=>"10252010",
        "4"=>"117255010",
        "5"=>"10010252",
        "6"=>"5178252",
        "7"=>"233058252",
        "8"=>"252236058",

    ];
    if(isset($colorMode[$name])){
        return $colorMode[$name];
    } else if(isset(array_flip($colorMode)[$name])){
        return array_flip($colorMode)[$name];
    }
    return $colorMode;
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