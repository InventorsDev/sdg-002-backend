<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $array['avatar'] = [
            'real' => $this->getFirstMedia('avatar')->getUrl(),
            'thumb' => $this->getFirstMedia('avatar')->getUrl('thumb'),
        ];
        return $array;
    }
}