<?php

namespace App\Http\Resources\Automat;

use App\Models\Product;
use Illuminate\Http\Resources\Json\JsonResource;

class DetailedAutomatResource extends JsonResource
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
            'automatId' => $this->automatId,
            'automatName' => $this->automatName,
            'shafts' => $this->shaft,
            'products' => Product::all()
        ];
    }
}
