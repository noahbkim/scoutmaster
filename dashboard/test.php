<?php

// Create a stream
$opts = array(
  "http"=>array(
    "method"=>"GET",
    "header"=>"Host: www.thebluealliance.com\r\n" .
	      "X-TBA-App-Id: frc449:scouting:0\r\n" .
              "Accept-language: en\r\n" .
              "User-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\r\n"
  )
);

$context = stream_context_create($opts);

// Open the file using the HTTP headers set above
$file = file_get_contents("http://www.thebluealliance.com/api/v2/team/449", false, $context);

echo $file;

?>
