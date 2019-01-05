<?php

    static public function set_hashed_passwd($inputPwd)
    {
        $output = password_hash($inputPwd, PASSWORD_BCRYPT);
        return $output;
    }


?>