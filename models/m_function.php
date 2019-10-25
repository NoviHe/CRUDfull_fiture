<?php
function status($stats){
    switch($stats){
        case 1 : $stats = '<button type="button" class="btn btn-success">OK</button>';
            Break;
        case 0 : $stats = '<button type="button" class="btn btn-danger">DOWN</button>';
            Break;
    }
    return $stats;
}

function error($serv){
    if ($serv == 0) {
        echo '<script language="javascript">';
        echo "var audio = new Audio('views/alarm2.mp3');"; 
        echo 'audio.play();';
        echo "setTimeout(function(){
            Swal.fire({
                type: 'error',
                title: 'Oops...',
                text: 'Something went wrong!'
              })
        },5000);";
        // echo 'alert("Error!");';
        echo '</script>';
    }        
}



function webCloud($url)
    {
        //create curl resource
        $ch=curl_init();
        //set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        //return example as astring
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //output contains
        $output = curl_exec($ch);
        //close curl 
        curl_close($ch);
        //mengembalkan hasil
        return $output;
    }

    function APIDomain($url)
    {
        //create curl resource
        $ch=curl_init();
        //set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        //return example as astring
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //output contains
        $output = curl_exec($ch);
        //close curl 
        curl_close($ch);
        //mengembalkan hasil
        return $output;
    }

    function Dashboard($url)
    {
        //create curl resource
        $ch=curl_init();
        //set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        //return example as astring
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //output contains
        $output = curl_exec($ch);
        //close curl 
        curl_close($ch);
        //mengembalkan hasil
        return $output;
    }

    function TIFA($url)
    {
        //create curl resource
        $ch=curl_init();
        //set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        //return example as astring
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //output contains
        $output = curl_exec($ch);
        //close curl 
        curl_close($ch);
        //mengembalkan hasil
        return $output;
    }

    function Jupiter($url)
    {
        //create curl resource
        $ch=curl_init();
        //set url
        curl_setopt($ch, CURLOPT_URL, $url);
        // set user agent    
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        //return example as astring
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //output contains
        $output = curl_exec($ch);
        //close curl 
        curl_close($ch);
        //mengembalkan hasil
        return $output;
    }