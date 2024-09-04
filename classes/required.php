<?php 

namespace Root\nader\required;

require_once 'Validator.php';

use Root\nader\exam\Validator;

class Required implements Validator {
    public function check($key ,$value){
        if(empty($value)){
            return "$key is required";
        }else{
            return false;
        }
    }

}