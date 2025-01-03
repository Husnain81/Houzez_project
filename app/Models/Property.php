<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Property extends Model
{
    use HasFactory,HasApiTokens;

    // Table name (optional if it follows naming conventions)
    protected $table = 'properties';

    // Fillable attributes for mass assignment
    protected $fillable = [
        'title',
        'description',
        'type',
        'status',
        'labels',
        'price',
        'second_price',
        'after_price_label',
        'price_prefix',
        'custom_fields',
        'bedrooms',
        'bathrooms',
        'garages',
        'garages_size',
        'area_size',
        'size_prefix',
        'land_area',
        'land_area_size_postfix',
        'user_id',
        'year_built',
        'additional_details',
    ];

    // Cast attributes to specific data types
    protected $casts = [
        'price' => 'decimal:2',
        'second_price' => 'decimal:2',
        'custom_fields' => 'array',
        'additional_details' => 'array',
    ];
}
