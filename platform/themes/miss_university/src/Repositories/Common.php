<?php

namespace Theme\Missuniversity\Repositories;

use Request;
use Illuminate\Support\Facades\Storage;

class Common {

    public function getIp(){
        $ip = '';
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }

    public function uploadImage($imageFolder, $inputname, $rename) {
        $file = Request::file($inputname);
        $extension = $file->extension();
        $minetype = $file->getMimeType();
        $image_name = $rename . '.' . $extension;
        $filename = $imageFolder . '/' . $image_name;
        $dest = $filename;
        if (!($file->isValid()) || $extension == 'exe' || !in_array($extension, ['jpg', 'png', 'jpeg']))
            return false;
        try {
            if (Storage::exists($dest))
                Storage::delete($dest);
            $result = Storage::putFileAs($imageFolder, $file, $image_name);
            $fileUpload = new \Illuminate\Http\UploadedFile('storage/'.$imageFolder.'/'.$image_name, $image_name, $minetype, null, true);
            $image = \RvMedia::handleUpload($fileUpload, 11);
            return $filename;
        } catch (Exception $e) {
            return false;
        }
    }
    
    public function getMemberId() {
        return \Session::get('login_member_59ba36addc2b2f9401580f014c7f58ea4e30989d');
    }

}
