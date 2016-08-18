<?php
require_once 'Action.php';
require_once 'ImageUploader.php';
require_once 'UserHandler.php';

define ("IMG_ROOT","/home/s16g10/public_html/pikture_data_engine/images/");
define ("IMG_WEB_ROOT","/~s16g10/pikture_data_engine/images/");

    /**
     * Interacts with a ArtItem table specified by the config.ini file
     *  
     * @since 1.0  
     */
    class ArtItemHandler extends DatabaseTableHandler
    {
        protected $id_col;
        protected $artist_id_col;
        protected $title_col;
        protected $description_col;
        protected $img_path_col;
        protected $site_visible_col;
        protected $byte_size_col;
        protected $added_date_col;
        protected $img_uploader;
        protected $action_collection;
        /**
         * Construct a handler for the basic interation with the ArtItem table
         * Subclass of DatabaseTableHandler for CRUD operations
         * @see DatabaseTableHandler
         * @see parse_ini_file()
         * @since 1.0
         * @return A constructed ArtItemHandler object using config.ini
         */
        public function __construct(){
            $config = parse_ini_file(CONFIG, true);
            parent::__construct(CONFIG, $config['art_item_table']['tablename']);
            $this->id_col = $config['art_item_table']['id'];
            $this->artist_id_col = $config['art_item_table']['artistid'];
            $this->title_col = $config['art_item_table']['title'];
            $this->description_col = $config['art_item_table']['description'];
            $this->img_path_col = $config['art_item_table']['imgpath'];
            $this->site_visible_col = $config['art_item_table']['sitevisible'];
            $this->byte_size_col = $config['art_item_table']['bytesize'];
            $this->added_date_col = $config['art_item_table']['addeddate'];
            $this->img_uploader = new ImageUploader();
            $this->action_collection = $this->initializeActions();
        }

        protected function initializeActions(){
            $actions = array();

            $valid_upload_params = array("title"=>true, "description"=>true,
                                         "license_web"=>false, "license_print"=>false,
                                         "license_unlimited"=>false, "category"=>false, "keywords"=>false);
            $upload_action = new Action("upload", $valid_upload_params,
                                 "upload");
            array_push($actions, $upload_action);

            $valid_search_params = array("title"=>false, 
                "description"=>false, "category"=>false);
            $search_action = new Action("search", $valid_search_params,
                "searchArt");
            array_push($actions, $search_action);

            $valid_retrieve_params = array("artist_id"=>true);
            $retrieve_action = new Action("getByArtistID", $valid_retrieve_params,
                "getByArtistID");
            array_push($actions, $retrieve_action);

            $valid_get_details_params = array("id"=>true);
            $get_details_action = new Action("getArtDetails", 
                    $valid_get_details_params,
                "getArtDetails");
            array_push($actions, $get_details_action);

            $valid_increment_params = array("id"=>true);
            $increment_action = new Action("incrementViewCount",
                    $valid_increment_params,"incrementViewCount");
            array_push($actions, $increment_action);
            
            $valid_top_views_params = array("max_results"=>true);
            $top_views_action = new Action("getTopViews",
                    $valid_top_views_params,"getTopViews");
            array_push($actions, $top_views_action);

            return new ActionCollection($actions);
        }

        public function performAction($name, $params){
            $action = $this->action_collection->getActionForName($name);
            if($action->verify($name, $params)){
                $ordered_params = $action->orderParams($params);
                return call_user_func_array(array($this,
                    $action->function_name), $ordered_params);
            }
        }
        
        public function getTopViews($max_results){
            header('Content-Type: application/json');
            echo json_encode($this->getTopN('view_count', $max_results));
        }

        public function searchArt($title="", $description="", $category=""){
            $results = array();
            $compare_values = array();
            if($title){
                $compare_values['title']=$title; 
            }
            if($description){
                $compare_values['description']=$description; 
            }
            if($category){
                $compare_values['category']=$category; 
            }
            $results = $this->search($compare_values);
            header('Content-Type: application/json');
            echo json_encode($results);
        }

        protected function getArtDetails($id){
            $search_vals = array("id"=>$id);
            $dbResults = $this->read($search_vals, array("*"), True);
            if(!empty($dbResults)){
                header('Content-Type: application/json');
                $jsonResult = json_encode($dbResults);
                echo $jsonResult;
            }
            return null;
        }

        protected function incrementViewCount($id){
            session_start();

            $user_handler = new UserHandler();
            $logged_in = $user_handler->isUserLoggedIn();

            $search_vals = array("id"=>$id);
            $dbResult = $this->read($search_vals, array("*"), True);
            if(!empty($dbResult)) {
                if($logged_in && ($_SESSION["user_id"] == $dbResult["artist_id"]))
                {
                    // don't allow to increment view count for images belonging to this user
                    return;
                }

                // increment view_count for this art item
                $viewCount = $dbResult["view_count"] + 1;

                $set_values = array("view_count" =>$viewCount);
                $this->update($set_values, $search_vals);
            }
        }

        protected function upload($title, $description, $license_web, $license_print,
                                  $license_unlimited, $category, $keywords ){
             // Create art_item record in database
            session_start();
            $img_path = $_FILES["img_path"];
            $tmp_path = $img_path["tmp_name"];
            $size = $img_path["size"];
            $name = basename($img_path["name"]);

            if($category === null)
                $category = "";
            if($keywords === null)
                $keywords = "";

            $insert_values=array("title"=>$title,
                                "description"=>$description,
                                "byte_size"=>$size,
                                "license_web"=>floatval($license_web),
                                "license_print"=>floatval($license_print),
                                "license_unlimited"=>floatval($license_unlimited),
                                "category"=>$category,
                                "keywords"=>$keywords,
                                "artist_id"=>$_SESSION["user_id"]);
            $id = $this->create($insert_values);
            $dir = IMG_ROOT.$id;

            $uploadResults = $this->img_uploader->uploadImage($tmp_path,
                $dir, $name, $size);

            if(is_array ($uploadResults))
            {
                $web_dir = IMG_WEB_ROOT.$id.'/';
                $set_values = array("img_path"=>$web_dir.$uploadResults['original'],
                    "img_path_medium"=>$web_dir.$uploadResults['medium'],
                    "img_path_small"=>$web_dir.$uploadResults['small']);
                $compare_values = array("id"=>$id);
                $this->update($set_values, $compare_values);
            }

            return is_array($uploadResults) ? null : "Upload Failed";
        }
        /**
         * Get columns of the ArtItem with the specified ArtistID foreign key.
         * Defaults to returning all data fields, unless $columns is specified.
         * @see DatabaseTableHandler
         * @since 1.0
         * @param int $id The ID of the user to retrieve from the database
         * @param array $columns The columns to retrieve. Defaults to all (*).
         * @return array. artItem details
         */
        public function getByArtistID($id, $columns=array('*')){
            header('Content-Type: application/json');
            $results=$this->read(array($this->artist_id_col=>$id), $columns, false);
            echo json_encode($results);
        }
    }