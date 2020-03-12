<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Slider extends JsonResource
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
            'id'            => $this->id,
            'title'         => $this->title,
            'description'   => $this->description,
            'content'       => $this->content,
            'thumbnail'     => $this->thumbnail,
            'link'          => $this->link,
            'status'        => $this->status,
            'created_by'    => $this->created_by,
            'created_at'    => $this->created_at,
            'updated_by'    => $this->updated_by,
            'updated_at'     => $this->updated_at
        ];
    }
}
