<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('metric_role', function (Blueprint $table) {
            $table->id();
            $table->bigInteger("role_id")->unsigned();
            $table->bigInteger("metric_id")->unsigned();
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('metric_id')->references('id')->on('metrics');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('metric_role');
    }
};
