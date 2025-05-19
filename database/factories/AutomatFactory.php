<?php

namespace Database\Factories;

use App\Models\Automat;
use Illuminate\Database\Eloquent\Factories\Factory;

class AutomatFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Automat::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'automatId' => $this->faker->userName,
            'automatName' => $this->faker->userName,
            'addressLine1' => $this->faker->streetName,
            'addressLine2' => $this->faker->buildingNumber,
            'zipCode' => $this->faker->postcode,
            'city' => $this->faker->city,
            'region' => $this->faker->state,
            'country' => $this->faker->country,
            'ipAddress' => $this->faker->ipv4,
            'macAddress' => $this->faker->macAddress,
            'SSID' => $this->faker->domainWord,
            'channel' => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 1, $max = 12),
            'encryption' => $this->faker->randomElement($array = array ('WEP', 'WPA', 'WPA2', 'WPA3')),
            'signalStrength' => $this->faker->randomFloat($nbMaxDecimals = 0, $min = 0, $max = 100),
            'lastReboot' => $this->faker->dateTime($max = 'now', $timezone = null),
            'doorStateOpen' => $this->faker->boolean,
            'lastDoorState' => $this->faker->dateTime($max = 'now', $timezone = null),
            'currentTemperature' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = -20, $max = 40),
            'currentHumidity' => $this->faker->randomFloat($nbMaxDecimals = 1, $min = 10, $max = 100),
            'machineSettings' => '{"Setting1": "Value"}',
            'telegramSettings' => '{"Setting1": "Value"}',
            'softReset' => $this->faker->boolean,
            'debugLevel' => $this->faker->numberBetween($min = 0, $max = 3),
        ];
    }
}