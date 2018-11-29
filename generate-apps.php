<?php
$files = glob("./production-instances/*.json");
foreach($files as $jsonfile){
    $json = json_decode(file_get_contents($jsonfile));
    // print_r($json);
    if (count($json->author_nicks)==1) {
        $groups=$json->author_nicks[0]->name;
    }
    if (count($json->author_nicks)==2) {
        $groups = $json->author_nicks[0]->name; 
        $groups .= " and ";
        $groups .= $json->author_nicks[1]->name;
    }
    if (count($json->author_nicks)==3) {
        $groups = $json->author_nicks[0]->name; 
        $groups .= ", ";
        $groups .= $json->author_nicks[1]->name;
        $groups .= " and ";
        $groups .= $json->author_nicks[2]->name;
    }
    $apptitle = strtolower($groups . " " . $json->title);
    $apptitle = str_replace(" ","-",$apptitle);
    echo $apptitle . "\n";
    $download = $json->download_links[0]->url;
    $download = str_replace('https://files.scene.org/view/',"http://archive.scene.org/pub/",$download);
    echo $download;
    mkdir ('./apps/'.$apptitle);
    $path = './apps/'.$apptitle.'/'.basename($download);
    $ch = curl_init($download);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($ch);
    curl_close($ch);
    echo $download." ";
    echo $path;
    file_put_contents($path, $data);
    file_put_contents($path.".md5",md5_file($path));
}
?>
