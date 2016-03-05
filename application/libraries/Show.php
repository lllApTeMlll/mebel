<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Show {

    public function show1($mas, $stop = false) {
        //echo "<script>console.log(" . json_encode($mas) . ")</script>";
        echo "<pre>";
        var_dump($mas);
        echo "</pre>";
        if ($stop)
            die();
    }

}
