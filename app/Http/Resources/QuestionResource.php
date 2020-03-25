<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "user"=>$this->user->name,
            "user_id"=>$this->user->id,
            "path"=>$this->path,
            "title"=>$this->title,
            "slug"=>$this->slug,
            "body"=>$this->body,
            "replies"=>ReplyResource::collection($this->replies),
            "replies_count"=>$this->replies->count(),
            "create_at"=>$this->created_at->diffForHumans(),
            "category"=>$this->category->name,
            "category_id"=>$this->category->id,

        ];
    }
}
