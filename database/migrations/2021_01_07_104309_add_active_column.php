<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddActiveColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('automats', function (Blueprint $table) {
            $table->boolean('active')->default('1')->nullable()->after('telegramSettings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('automats', function (Blueprint $table) {
            $table->dropColumn('active');
        });
    }
}
