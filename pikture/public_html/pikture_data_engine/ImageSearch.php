<?php
    require_once 'DatabaseExceptions.php';
    require_once 'DatabaseTableHandler.php';
    define ("CONFIG", "config.ini");
    
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
    class ImageSearch
    {
        protected $user_table;
        
        
        public function __construct(){
            $config = parse_ini_file(CONFIG, true);
            $this->user_table = new DatabaseTableHandler(CONFIG, 'Art_Item');
        }
        
        public function doSearch($search_vals)
        {
           return  $results = $this->user_table->search($search_vals);  
        }
    }
    
$args = $_POST;

//passed in arguments
$search_val = $args['searchValue'];

// passed in arguments
$search_vals = array("description"=> $search_val);

$search = new ImageSearch();
$dbResults = $search->doSearch($search_vals);
header('Content-Type: application/json');
echo json_encode($dbResults);
// //create test values
// $result = new ResultSet();
// $result->searchString = $search_vals;
// $result->response = "success";
// $result->recordsFound = "21";

// //return one actual image
// $image1 = new Image();
// $image1->id = "1";
// $image1->url = "108H.jpg";
// $image1->name = "Balloon girl";
// $image1->description = "Girl with balloons";
// $image1->tags = "balloons";

// $imageList[] = $image1;

// //populate 10 additional test images
// for ($i = 0; $i < 20; $i++) {
//     $img = new Image();
//     $img->id = "1";
//     $img->url = "test.jpg";
//     $img->name = "Test Title";
//     $img->description = "Here is some test description text for this image. Created for test purposes of the site. Test test test.";
//     $img->tags = "test";
    
//     $imageList[] = $img;
// }

// $result->images = $imageList;

// print_r($result->images);

// 
