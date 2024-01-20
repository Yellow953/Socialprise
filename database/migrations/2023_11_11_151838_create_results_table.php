<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->unsignedBigInteger('page_id');
            $table->string('metric_name');
            $table->string('metric_period')->nullable();
            $table->dateTime('end_time1');
            $table->double('value1');
            $table->dateTime('end_time2')->nullable();
            $table->double('value2')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('results');
    }
};
