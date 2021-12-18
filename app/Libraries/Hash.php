<?php

namespace App\Libraries;

class Hash{

    public static function make($password){
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public static function check($entered_password, $db_password){
        $result = false;

        if(password_verify($entered_password, $db_password)){
            $result = true;
        }

        return $result;
    }
}

?>