<?php

namespace Theme\Missuniversity\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Theme\Missuniversity\Http\Requests\ThisinhRequest;
use Theme\Missuniversity\Http\Requests\ThisinhuploadRequest;
use Theme;
use Illuminate\Http\Request;

class ThisinhController extends PublicController {

    public function __construct() {
        $this->thisinhRepo = new Theme\Missuniversity\Repositories\ThisinhRepo();
    }

    function register(ThisinhRequest $request) {
        $result = $this->thisinhRepo->register($request);
        return response()->json(['success' => $result]);
    }
    
    function updateInfo(ThisinhuploadRequest $request) {
        $result = $this->thisinhRepo->updateInfo($request);
        return response()->json(['success' => $result]);
    }
    
    public function uploadPhoto($folder, $inputname) {
        $result = $this->thisinhRepo->uploadImage($folder, $inputname);
        return response()->json(['path' => $result]);
    }
    
    /*public function test() {
        return view('theme.miss_university::views.mvc.post');
    }*/
}

