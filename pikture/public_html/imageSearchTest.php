<?php

class Image {

    public $id = "";
    public $url = "";
    public $name = "";
    public $description = "";
    public $tags = "";

}

class ResultSet {

    public $searchString = "";
    public $response = "";
    public $recordsFound = "";
    public $images = "";

}

//use the data sent to the server
$args = $_POST;

//passed in arguments
$search_vals = $args['searchValue'];

//for search field will be 0
//for category selected will be 1
$search_desc = $args['searchDescription'];

//create test values
$result = new ResultSet();
$result->searchString = $search_vals;
$result->response = "success";
$result->recordsFound = "21";

//return one actual image
$image1 = new Image();
$image1->id = "1";
$image1->url = "108H.jpg";
$image1->name = "Balloon girl";
$image1->description = "Girl with balloons";
$image1->tags = "balloons";

$imageList[] = $image1;

//populate 10 additional test images
for ($i = 0; $i < 20; $i++) {
    $img = new Image();
    $img->id = "1";
    $img->url = "test.jpg";
    $img->name = "Test Title";
    $img->description = "Here is some test description text for this image. Created for test purposes of the site. Test test test.";
    $img->tags = "test";
    
    $imageList[] = $img;
}

$result->images = $imageList;

echo json_encode($result);

