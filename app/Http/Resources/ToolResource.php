<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ToolResource extends JsonResource
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
            'toolId'=>$this->id,
            'toolName'=>$this->name,
            'toolPrice'=>$this->price,
            'toolState'=>($this->state == 1 ) ? 'Available' : 'Not available',
            'toolDescription'=>$this->description,
            'toolCategory'=>$this->category->name,
            'toolUser'=>$this->user->fullName,
            'toolImages'=>$this->pictures()->get('path'),
        ];
    }
}
