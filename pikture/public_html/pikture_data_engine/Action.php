<?php
    require_once 'ActionExceptions.php';
/**
* The action class provides a mapping between an action name, function name to
* be performed, and the list of parameters that are valid for a given action. 
* The intended use-case of Action is for validation of $_POST arguments passed
* via an HTTP request that have a corresponding method to be performed
* 
* The action class provides verification functions so the user of the class
* doesn't have to repeat common parsing of the $_POST arguments to ensure they
* are valid.    
* 
* action_function
* @since 1.0
*/
class Action{
    /**
    * string name of valid action to be created 
    * @var action_name 
    */
    public $action_name; 
    /**
     * array Associative array of parameters=>boolean value to indicate required
     * @var valid_params
     */
    public $valid_params; 
    /**
    * string Name of function to call on parameters
    * @var function_name
    */
    public $function_name;
    
    /**
         * Create an action with valid params and a callback function
         * $valid_params must be in the order that they will be passed to
         * the function specified 
         * @since 1.0
         */
    public function __construct($action_name, $valid_params, $function_name){
        $this->action_name = $action_name;
        $this->valid_params = $valid_params;
        $this->function_name = $function_name;
    }
    /**
      * Match the proposed string action name to the name of this action
      * @since 1.0
      * @return boolean true if match, false if not a match
      */
    public function nameMatch($proposed_name){
        return $this->action_name===$proposed_name;
    }
    /**
      * Match the proposed string action name to the name of this action
      * @since 1.0
      * @return boolean true if match, false if not a match
      */
    public function isValidParam($proposed_param){
        if(array_key_exists($proposed_param, $this->valid_params)){
            return true;
        }
        else{
            return false;
        }
    }
    
    /**
      * Match every proposed string action name to the name of this action
      * @since 1.0
      * @return boolean true if match, false if not a match
      */
    public function areValidParams($proposed_params){
        foreach(array_keys($proposed_params) as $proposed_param){
            if(!$this->isValidParam($proposed_param)){
                throw new InvalidParameterForActionException(
                        $this->action_name.' '.$proposed_param);
            }
        }
        return true;
    }
    
    /**
      * Verify the specified parameter names with the params in the Action object
      * @since 1.0
      * @return boolean true if all valid params, false otherwise
      */
    public function hasRequiredParams($proposed_params){
        foreach($this->valid_params as $param=>$required){
            if ($required && !isset($proposed_params[$param])){
                throw new RequiredParameterForActionException($param);
            } 
        }
        return true;
    }
    
    /**
      * Check whether the specified action and parameters match those in the
      * Action object. Also ensure that all required params are present 
      * @since 1.0
      * @return boolean true if all conditions verified, false otherwise
      */
    public function verify($action_name, $params){
        return $this->nameMatch($action_name)&& 
                $this->hasRequiredParams($params)&&
                $this->areValidParams($params);
    }
    
    /**
      * Ensure that the parameters are in the same order as $this->$valid_params
      * @since 1.0
      * @return the same param array in the same order as $this->valid_parms
      */
    public function orderParams($unordered_params){
        $ordered_params = array();
        foreach($this->valid_params as $param_name=>$param_value){
            if(array_key_exists($param_name, $unordered_params)){
                $ordered_params[$param_name]=$unordered_params[$param_name];
            }
        }
        return $ordered_params;
    }
    
}


/**
* Short utility class to provide an interface for getting an action from a 
* collection of actions. 
* @since 1.0
*/
class ActionCollection{
    public $actions;
    
    public function __construct($actions){
        $this->actions = $actions;
    }
    
    public function getActionForName($name){
        foreach ($this->actions as $action){
            if ($action->nameMatch($name)){
                return $action;
            }
        }
        throw new InvalidActionException($name);
    }
    
}