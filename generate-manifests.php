<?php
$apps = glob("./apps/*");
foreach($apps as $app){
    $files = glob("./".$app."/*");
    foreach($files as $file){
        if(strpos($file,".md5")!== false){
         $url = "http://rc55.com/apps/".basename($app)."/".basename($file);
         $hash = file_get_contents($file);
         $toenc = array('version'=>'1.0', 'url'=>$url, 'hash'=>$hash);
         $jsonout = json_encode($toenc);
         $jsonout = str_replace("\/", "/",$jsonout);
         $jsonout = str_replace(".md5", "",$jsonout);
         file_put_contents("./bucket/".basename($app).".json",$jsonout);
        }
    }
}
?>
