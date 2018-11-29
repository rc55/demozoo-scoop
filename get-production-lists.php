<?php

// Determine JSON pagination total
// Headers set to return HTML instead of raw JSON, last pagination count parsed as the 12th <a> on the page
$options = array(
    'http'=>array(
        'method'=>"GET",
        'header'=>"Accept-language: en\r\n" .
                "Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8\r\n"
    )
);

$context = stream_context_create($options);
$html = file_get_contents("http://demozoo.org/api/v1/productions/", false, $context);

$doc = new DOMDocument;
$doc->loadhtml($html);

$items = $doc->getElementsByTagName('a');
echo $items->item(12)->nodeValue."\n";
$pagecount = $items->item(12)->nodeValue;

// Dump JSON pages
for($i=1; $i<=$pagecount ;$i++){
    if(!file_exists("./production-lists/$i.json")){
    $json = file_get_contents("http://demozoo.org/api/v1/productions/?format=json&page=$i");
    file_put_contents("./production-lists/$i.json",$json);
    sleep(1);
    echo "$i.json\n";
    }
}

?>