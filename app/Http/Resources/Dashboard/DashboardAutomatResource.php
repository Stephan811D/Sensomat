<?php

namespace App\Http\Resources\Dashboard;

use App\Http\Resources\Dashboard\DashboardShaftResource;
use Illuminate\Http\Resources\Json\JsonResource;

class DashboardAutomatResource extends JsonResource
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
            'automatName' => $this->automatName,
            'environmentStatus' => [
                'currentTemperature' => $this->currentTemperature,
                'currentHumidity' => $this->currentHumidity,
            ],
            'fillingStatus' => $this->getCurrentState(),
            'networkStatus' => [
                'ipAddress' => $this->ipAddress,
                'SSID' => $this->SSID,
                'signalStrength' => $this->signalStrength,
                'onlineStatus' => $this->getOnlineStatus(),
                'lastAccess' => 'vor '.$this->getLastAccess(),
            ],
            'doorStatus' => [
                'doorStateOpen' => $this->doorStateOpen,
                'lastDoorState' => 'vor '.$this->getLastDoorState(),
            ],
            'shafts' => DashboardShaftResource::collection($this->whenLoaded('shaft'))->unique()->toArray()
        ];
    }
}
