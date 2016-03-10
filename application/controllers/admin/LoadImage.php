<?php

class LoadImage extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->model('Load_model');
        //$this->load->library('session');
        $this->user_model->isAvtoris(); 
        $this->load->library('image_lib');
        // $this->delWithout();
    }

    public function load() {
        //echo "load";
        //var_dump($_FILES);
        if (isset($_FILES["files"]["tmp_name"])) {
            $allowedExts = array("gif", "jpeg", "jpg", "png", "blob");

            $temp = explode(".", $_FILES["files"]["name"]);

            $extension = end($temp);

            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES["files"]["tmp_name"]);

            if ((($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/pjpeg") || ($mime == "image/x-png") || ($mime == "image/png")) && in_array(strtolower($extension), $allowedExts)) {
                $filename = md5(uniqid(rand(), true));
                copy($_FILES["files"]["tmp_name"], BASE . '/files/images2/small/' . $filename . "1.jpg");
                $config = array(
                    'image_library' => 'imagemagick',
                    'library_path' => '/usr/bin/',
                    'source_image' => $_FILES["files"]["tmp_name"], //path to the uploaded image
                    'new_image' => BASE . '/files/images2/big/' . $filename . ".jpg",
                    'maintain_ratio' => true,
                    'create_thumb' => false,
                    'quality' => 95,
                    'width' => $this->input->post('max', true),
                );
                $mas['error'] = "";
                if ($this->input->post('onlismall', true) === "small") {
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                    $mas['error'] = $this->image_lib->display_errors();
                    $this->image_lib->clear();
                }


                $config['new_image'] = BASE . '/files/images2/small/' . $filename . ".jpg";
                $config['width'] = $this->input->post('min', true);

                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $mas['error'] .= $this->image_lib->display_errors();
                $this->image_lib->clear();
                $mas1 = array("Puth" => '/files/images2/', "Name" => $filename . ".jpg");
                $this->Load_model->insert($mas1);
                $mas['elem'] = $this->Load_model->getPhotos(array("name" => $filename . ".jpg", "count" => 1), $this->input->post('vid', true));
                echo json_encode($mas);
            }
        }
    }

}
