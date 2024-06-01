<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up():void
    {
        Schema::create('rubrics', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('ident')->unique();
            $table->timestamps();
        });

        Schema::create('subrubrics', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('ident')->unique();
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('ident')->unique();
            $table->timestamps();
        });

        Schema::create('manufacturers', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('ident')->unique();
            $table->timestamps();
        });

        Schema::create('goods', function (Blueprint $table) {
            $table->bigInteger('id', true, true);
            $table->string('title')->nullable();
            $table->string('article')->unique();
            $table->text('description');
            $table->unsignedFloat('cost');
            $table->string('warranty');
            $table->string('status');

            $table->unsignedBigInteger('rubric_id')->nullable();
            $table->unsignedBigInteger('subrubric_id')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('manufacturer_id')->nullable();

            $table->foreign('rubric_id')->references('id')->on('rubrics')->nullOnDelete();
            $table->foreign('subrubric_id')->references('id')->on('subrubrics')->nullOnDelete();
            $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            $table->foreign('manufacturer_id')->references('id')->on('manufacturers')->nullOnDelete();

            $table->timestamps();
        });
    }
};
