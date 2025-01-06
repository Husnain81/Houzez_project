<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('property_name');
            $table->string('address');
            $table->string('country');
            $table->string('county_state');
            $table->text('private_note')->nullable();
            $table->string('attachment')->nullable();
            $table->string('virtual_tour')->nullable();
            $table->string('package')->nullable();
            $table->string('image')->nullable();
            $table->string('video_url')->nullable();
            $table->string('city');
            $table->string('price_postfix')->nullable();
            $table->integer('size')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('postal_code');
            $table->decimal('latitude', 10, 8);
            $table->decimal('longitude', 11, 8);
            $table->text('map_street_view')->nullable();
            $table->string('features')->nullable();  
            $table->string('title');
            $table->string('description')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->default('draft');
            $table->string('labels')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('second_price', 10, 2)->nullable();
            $table->string('price_label')->nullable();
            $table->string('after_price_label')->nullable();
            $table->string('price_prefix')->nullable();
            $table->text('custom_fields')->nullable();
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->integer('garages')->nullable();
            $table->string('garages_size')->nullable();
            $table->integer('area_size');
            $table->string('size_prefix')->nullable();
            $table->integer('land_area')->nullable();
            $table->string('land_area_size_postfix')->nullable();
            $table->string('user_id')->unique();
            $table->integer('year_built')->nullable();
            $table->string('additional_details')->nullable();
            $table->string('energy_class')->nullable();  // Energy Class
            $table->decimal('global_energy_performance_index', 10, 2)->nullable(); // Global Energy Performance Index
            $table->decimal('renewable_energy_performance_index', 10, 2)->nullable(); // Renewable Energy Performance Index
            
            $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
