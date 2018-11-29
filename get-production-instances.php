<?php

$files = glob("./production-lists/*.json");
foreach($files as $jsonfile){
    $json = json_decode(file_get_contents($jsonfile));
    $count = (count($json->results));
    foreach($json->results as $result) {
        echo $result->id . "\n";
        if(!file_exists("./production-instances/$result->id.json")){
            file_put_contents("./production-instances/$result->id.json",file_get_contents($result->url));
            sleep(1);
        }
    }
}

?>
