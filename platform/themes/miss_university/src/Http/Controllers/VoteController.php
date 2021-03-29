<?php

namespace Theme\Missuniversity\Http\Controllers;

use Botble\Theme\Http\Controllers\PublicController;
use Theme\Missuniversity\Http\Requests\VoteallRequest;
use Theme;

class VoteController extends PublicController {

    public function __construct() {
        $this->voteRepo = new Theme\Missuniversity\Repositories\Vote();
        $this->voteRepoDis = new Theme\Missuniversity\Repositories\Vote();
    }


    function doVote(VoteallRequest $request) {

        return response()->json($this->voteRepo->doVote($request));
    }
    function doVoteDis(VoteallRequest $request) {

        return response()->json($this->voteRepoDis->doVoteDis($request));
    }

}

