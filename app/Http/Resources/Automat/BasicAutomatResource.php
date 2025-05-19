<?php

namespace App\Http\Resources\Automat;

use Illuminate\Http\Resources\Json\JsonResource;

class BasicAutomatResource extends JsonResource
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
            'addressLine1' => $this->addressLine1,    
            'addressLine2' => $this->addressLine2,    
            'zipCode' => $this->zipCode,    
            'city' => $this->city,    
            'region' => $this->region,    
            'country' => $this->country
        ];
    }
}
