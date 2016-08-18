<?php

define ("CONFIG", "config.ini");
 

    /**
     * Interacts with a ArtRequest table specified by the config.ini file
     *  
     * @since 1.0
     */
    class ArtRequestHandler extends DatabaseTableHandler
    {
        protected $artist_id_col;
        protected $title_col;
        protected $description_col;
        protected $img_path_col;
        protected $site_visible_col;
        protected $byte_size_col;
        protected $added_date_col;
        protected $action_collection;

        /**
         * Construct a handler for the basic interaction with the ArtRequest table
         * Subclass of DatabaseTableHandler for CRUD operations
         * @see DatabaseTableHandler
         * @see parse_ini_file()
         * @since 1.0
         */
        public function __construct(){
            $config = parse_ini_file(CONFIG, true);
            parent::__construct(CONFIG, $config['art_request_table']['tablename']);

            $this->action_collection = $this->initializeActions();
        }

        protected function initializeActions(){
            $actions = array();

            $valid_params = array("title"=>true, "description"=>true, "price_offer"=>true);
            $action = new Action("add_art_request", $valid_params,
                                 "add_art_request");
            array_push($actions, $action);

            $valid_params = array();
            $action = new Action("getArtRequest", $valid_params,
                                 "getArtRequest");
            array_push($actions, $action);


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

        protected function getArtRequest(){
            $dbResult = $this->getTopN("id", 100);
            header('Content-Type: application/json');
            echo json_encode($dbResult);
        }

        protected function add_art_request($title,$description,$price_offer ){
             // Create art_item record in database
            session_start();

            $insert_values=array("title"=>$title,
                                 "description"=>$description,
                                 "price_offer"=>floatval($price_offer),
                                 "customer_id"=>$_SESSION["user_id"]);
            $id = $this->create($insert_values);

            header('Location: /~s16g10/art-requests/index.html');
            exit;
        }

        
    }

    function __autoload($class_name) {
        require_once $class_name . '.php';
    }