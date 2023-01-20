<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->boolean("for_sale");
            $table->boolean("for_rent");
            $table->boolean("is_sold");
            $table->integer('price');
            $table->string('currency');
            $table->string('currency_symbol');
            $table->string('property_type');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('area');
            $table->string('area_type');
            $table->string('photo_thumb');
            $table->string('photo_search');
            $table->string('photo_full');
            $table->longText('street');
            $table->foreignId('province_id')->constrained();
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
        Schema::dropIfExists('properties');
    }
};
