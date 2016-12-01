<?php
use iamdual\Upload;
/**
* 文件上传类
*/
class Upload{

    function __construct(){
        if (isset($_FILES["file"])) {
            $upload = new Upload($_FILES["file"]);
            $upload->allowed_extensions(array("png", "jpg", "jpeg", "gif"));
            $upload->allowed_types(array("image/png", "image/jpeg"));
            $upload->max_size(5); //MB
            $upload->new_name("hello");
            $upload->path("upload/files");

            if (! $upload->upload()) {
                echo "Upload error: " . $upload->error();
            }
            else {
                echo "Upload successful!";
            }

        }
    }

}

