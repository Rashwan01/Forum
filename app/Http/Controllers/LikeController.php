<?php

namespace App\Http\Controllers;

use App\Events\LikeEvent;
use App\Model\Like;
use App\Model\Reply;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
                "user_id"=>auth()->user()->id
            ]);

            broadcast(new LikeEvent($reply->id,1))->toOthers();
            return response()->json("created",Response::HTTP_CREATED);

        }
        public function unLikeIt(Reply $reply){

            $reply->like()-> where("user_id",auth()->user()->id)->first()->delete();
            broadcast(new likeEvent($reply->id,0))->toOthers();

            return response(null,Response::HTTP_NO_CONTENT);

        }
    }
