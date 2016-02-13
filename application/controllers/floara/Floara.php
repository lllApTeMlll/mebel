<?php

class Floara extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('user_model');
        $this->load->library('image_lib');
        $this->user_model->isAvtoris();
    }

    public function uploadImage() {
        if (isset($_FILES["file"]["name"])) {
            // var_dump($_FILES);die();
            $allowedExts = array("gif", "jpeg", "jpg", "png", "blob");

            // Get filename.
            $temp = explode(".", $_FILES["file"]["name"]);

            // Get extension.
            $extension = end($temp);

            // An image check is being done in the editor but it is best to
            // check that again on the server side.
            // Do not use $_FILES["file"]["type"] as it can be easily forged.
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

            if ((($mime == "image/gif") || ($mime == "image/jpeg") || ($mime == "image/pjpeg") || ($mime == "image/x-png") || ($mime == "image/png")) && in_array(strtolower($extension), $allowedExts)) {
                // Generate new random name.
                $name = sha1(microtime()) . "." . $extension;

                // Save file in the uploads folder.
                $config = array(
                    'image_library' => 'imagemagick',
                    'library_path' => '/usr/bin/',
                    'source_image' => $_FILES["file"]["tmp_name"], //path to the uploaded image
                    'new_image' => BASE . '/files/site/uploads/' . $name,
                    'maintain_ratio' => true,
                    'create_thumb' => false,
                    'quality' => 90,
                    'width' => 1000,
                );
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $mas['error'] = $this->image_lib->display_errors();
                $this->image_lib->clear();
                //copy($_FILES["file"]["tmp_name"], BASE . "/files/site/uploads/" . $name);
                // Generate response.
                $response = new StdClass;
                $response->link = "/files/site/uploads/" . $name;
                echo stripslashes(json_encode($response));
            }
        }
    }

    public function imageManager() {
        $response = array();

        // Image types.
        $image_types = array(
            "image/gif",
            "image/jpeg",
            "image/pjpeg",
            "image/jpeg",
            "image/pjpeg",
            "image/png",
            "image/x-png"
        );

        // Filenames in the uploads folder.
        $fnames = scandir(BASE . "/files/site/uploads/");

        // Check if folder exists.
        if ($fnames) {
            // Go through all the filenames in the folder.
            foreach ($fnames as $name) {
                // Filename must not be a folder.
                if (!is_dir($name)) {
                    // Check if file is an image.
                    if (in_array(mime_content_type(getcwd() . "/files/site/uploads/" . $name), $image_types)) {
                        // Build the image.
                        $img = new StdClass;
                        $img->url = "/files/site/uploads/" . $name;
                        $img->thumb = "/files/site/uploads/" . $name;
                        $img->name = $name;

                        // Add to the array of image.
                        array_push($response, $img);
                    }
                }
            }
        }

        // Folder does not exist, respond with a JSON to throw error.
        else {
            $response = new StdClass;
            $response->error = "Images folder does not exist!";
        }

        $response = json_encode($response);

        // Send response.
        echo stripslashes($response);
    }

    public function fileUpload() {
        $allowedExts = array("txt", "pdf", "doc");

        // Get filename.
        $temp = explode(".", $_FILES["file"]["name"]);

        // Get extension.
        $extension = end($temp);

        // Validate uploaded files.
        // Do not use $_FILES["file"]["type"] as it can be easily forged.
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

        if ((($mime == "text/plain") || ($mime == "application/msword") || ($mime == "application/x-pdf") || ($mime == "application/pdf")) && in_array(strtolower($extension), $allowedExts)) {
            // Generate new random name.
            $name = sha1(microtime()) . "." . $extension;

            // Save file in the uploads folder.
            move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploads/" . $name);

            // Generate response.
            $response = new StdClass;
            $response->link = "/uploads/" . $name;
            echo stripslashes(json_encode($response));
        }
    }

}
