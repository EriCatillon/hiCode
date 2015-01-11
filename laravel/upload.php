<?php
/*
Method to upload image into Laravel 

In app/config/website.php

return [ 'folderImage' => './assets/images',];

In app/controllers/AdminPostController.php 
*/

class AdminController extends Controller{
  private function upload() {
        
    if (Input::hasFile('thumbnail') && Input::file('thumbnail')->isValid()) {

        $file = Input::file('thumbnail');
//             $fileName = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();
        $fileName = str_random(12).".".$ext;
        $file->move(Config::get('website.folderImage'), $fileName);
        chmod(Config::get('website.folderImage').DIRECTORY_SEPARATOR.$fileName, 0777);
        return $fileName;

        }else{
            return false;
        }
    }

}
