<?php 

namespace Root\nader\required;
require_once 'Validator.php';

use Root\nader\exam\Validator;

class Str implements Validator {
    public function check($key ,$value){
        if(is_numeric($value)){
            return "$key must be string ";
        }else{
            return false;
        }
    }

}