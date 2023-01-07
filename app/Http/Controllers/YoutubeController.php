<?php

namespace App\Http\Controllers;

use App\Events\VideoViews;
use App\Models\Video;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index(){
        $nbrViews = Video::first();
        event(new VideoViews($nbrViews)); //fire event
        return view('youtube', compact("nbrViews"));
    }
}
