<?php
namespace core;
/**
 * Request class
 */
class Request extends Rules
{
    public $errors = [];
    public $requestData = [];
    
    public function getPath()
    {

        $path = rtrim($_SERVER['REQUEST_URI'], '/');
        return empty($path) ? '/' : $path;
    }

    public function getMethod()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }


    public function isPost()
    {
        return $this->getMethod()=== 'post' ? true : false;
    }

    public function getBody(){
        $body=[];
        if($this->getMethod() === "get"){
            foreach ($_GET as $key => $value){
                $body[$key] = filter_input(INPUT_GET,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if($this->getMethod() === "post"){
            foreach ($_POST as $key => $value){
                $body[$key] = filter_input(INPUT_POST,$key,FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $body;
    }


    public function validate($attrRules = [])
    {
        foreach ($attrRules as $attribute => $rules) {
            $value = $this->getBody()[$attribute]??0;

            foreach($rules as $rule){
                $rulename = is_string($rule)?$rule:$rule[0];
                if($rulename === self::RULE_REQUIRED && empty($value) ){
                    $this->errors[$attribute] = "{$attribute} is required";
                }
                else if($rulename !== self::RULE_MERGE && !empty($value)) {
                    $this->requestData[$attribute] = $value;
                }

                else if($rulename === self::RULE_MERGE && isset($this->requestData[$rule[1]])){
                     $this->requestData[$rule[1]] .= " {$value}";
                    unset($this->requestData[$attribute]);                    
                }
                else if($rulename === self::RULE_BOOLEAN && isset($this->getBody()[$attribute])){
                    $this->requestData[$attribute] = 1;
                }
            
            }

        }

        return empty($this->errors) ? $this->requestData : false;
       
    }


    public function valid()
    {
        return empty($this->errors)??false;
    }


    
}
