<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutomatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('automats', function (Blueprint $table) {
            $table->increments('id');
            
            //machine
            $table->string('automatId', 50)->unique();
            $table->string('automatName', 50);
            
            //address
            $table->string('addressLine1', 50);
            $table->string('addressLine2', 50);
            $table->string('zipCode', 10);
            $table->string('city', 50);
            $table->string('region', 50);
            $table->string('country', 50);
            
            //network
            $table->ipAddress('ipAddress')->nullable();
            $table->macAddress('macAddress')->nullable();
            $table->string('SSID', 100)->nullable();
            $table->tinyInteger('channel')->nullable();
            $table->enum('encryption', ['WEP', 'WPA', 'WPA2', 'WPA3'])->nullable();
            $table->integer('signalStrength')->nullable();
            
            //states
            $table->boolean('softReset')->nullable();
            $table->timestamp('lastReboot', 0)->nullable();
            $table->boolean('doorStateOpen')->nullable();
            $table->timestamp('lastDoorState', 0)->nullable();
            $table->integer('currentTemperature')->nullable();
            $table->integer('currentHumidity')->nullable();
            
            //settings
            $table->tinyInteger('debugLevel')->nullable();
            $table->json('machineSettings')->nullable();
            $table->json('telegramSettings')->nullable();
            
            //timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('automats');
    }
}
