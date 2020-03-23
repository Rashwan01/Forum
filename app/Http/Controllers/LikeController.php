<?php

namespace App\Http\Controllers;

use App\Model\Like;
use App\Model\Reply;
use Illuminate\Http\Request;

class LikeController extends Controller
{

        /**
     * Create a new AuthController instance.
     *
     * @return void
     */
        public function __construct()
        {
            $this->middleware('jwt');
        }

        public function likeIt(Reply $reply){
            $reply->like()->create([
                "user_id"=>1 
            ]);
            return response()->json("created",Response::HTTP_CREATED);

        }
        public function unLikeIt(Reply $reply){

            $reply->like()-> where("user_id","1")->first()->delete();
            return response(null,Response::HTTP_NO_CONTENT);

        }
    }
