<?php
namespace Google\Cloud\Samples\Vision;
use Google\Cloud\Vision\V1\ImageAnnotatorClient;
require_once('google-cloud/vision');
//require google/cloud-vision;
$apikey= "apikey";
 $projectId = 'DOT_Recognition';
 $path = "Desktop/DOT_Truck.JPEG";
 print_r($path);
/*
 $url = "https://vision.googleapis.com/v1/images:annotate?key=$apikey";
	// create curl resource
	$ch = curl_init();

	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
	//The contents of the "User-Agent: " header to be used in a HTTP request.
	curl_setopt( $ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13' );

	$response = curl_exec( $ch );
 print_r($response);
 exit;*/

 

function detect_text($path)
{
    $imageAnnotator = new ImageAnnotatorClient();
    # annotate the image
    $image = file_get_contents($path);
    $response = $imageAnnotator->textDetection($image);
    $texts = $response->getTextAnnotations();
    printf('%d texts found:' . PHP_EOL, count($texts));
    foreach ($texts as $text) {
        print_r($text->getDescription() . PHP_EOL);
        # get bounds
        $vertices = $text->getBoundingPoly()->getVertices();
        $bounds = [];
        foreach ($vertices as $vertex) {
            $bounds[] = sprintf('(%d,%d)', $vertex->getX(), $vertex->getY());
        }
        print_r('Bounds: ' . join(', ',$bounds) . PHP_EOL);
    }
}

$imagepath= "Desktop/DOT_Truck.JPEG";
$response= detect_text($imagepath);

?>
