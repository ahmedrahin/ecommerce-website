<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            // Add timestamps columns
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('model_has_roles', function (Blueprint $table) {
            // Remove the timestamps columns
            $table->dropTimestamps();
        });
    }
};
