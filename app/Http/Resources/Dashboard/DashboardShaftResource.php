<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\Dashboard\DashboardProductResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardShaftResource extends JsonResource
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
            'shaft_id' => $this->shaft_id,
            'product' => new DashboardProductResource($this->product),
            'active' => $this->active,
            'capacity' => $this->capacity,
            'level' => $this->level,
        ];
    }
}
