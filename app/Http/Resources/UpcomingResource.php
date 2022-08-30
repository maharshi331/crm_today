<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UpcomingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
         return [
            'id' => $this->id,
            'title'=>$this->title,
            'upcoming'=>$this->upcoming,
            'waiting'=>$this->waiting,
            'approved'=>$this->approved,
            'taskId'=>$this->taskId,
        ];
    }
}
