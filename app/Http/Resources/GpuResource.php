<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GpuResource extends JsonResource
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
            'name' => $this->name,
            'manufacturer_id' => $this->manufacturer_id,
            'user_id' => $this->user_id,
            'clock' => $this->clock,
            'vram' => $this->vram,
        ];
    }
}
