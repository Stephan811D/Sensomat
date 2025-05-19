<?php

namespace App\Http\Resources;

use App\Models\Automat;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'productType_id' => $this->productType->id,
            'productType' => $this->productType->productType,
            'productName' => $this->productName,
            'price' => $this->price,
            'color' => $this->color,
            'automats' => AutomatResource::collection($this->whenLoaded('automat'))->where('active', 1)->unique()->toArray()
        ];
    }
}