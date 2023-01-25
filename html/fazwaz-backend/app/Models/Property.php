<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'for_sale',
        'for_rent',
        'is_sold',
        'price',
        'currency',
        'currency_symbol',
        'property_type',
        'bedrooms',
        'bathrooms',
        'area',
        'area_type',
        'photo_thumb',
        'photo_search',
        'photo_full',
        'street',
        'province_id',
    ];

    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'for_sale' => 'boolean',
        'for_rent' => 'boolean',
        'is_sold' => 'boolean',
        'price' => 'integer',
        'currency' => 'string',
        'currency_symbol' => 'string',
        'property_type' => 'string',
        'bedrooms' => 'integer',
        'bathrooms' => 'integer',
        'area' => 'string',
        'area_type' => 'string',
        'photo_thumb' => 'string',
        'photo_search' => 'string',
        'photo_full' => 'string',
        'street' => 'string',
        'province_id' => 'integer',
    ];

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function scopeSearch($query, $search)
    {
        $query->where('title', 'like', '%' . $search . '%');
    }

    public function scopeProvinces($query, $provinces)
    {
        if ($provinces != '') {
            $activeProvinces = explode(',', $provinces);
            if (count($activeProvinces) > 0) {
                $query->whereHas('province',  function ($query) use ($activeProvinces) {
                    $query->whereIn('title', $activeProvinces);
                });
            }
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status != '') {
            $activeStatuses = explode(',', $status);
            if (count($activeStatuses) == 1) {
                if ($activeStatuses[0] == 'Sold') {
                    $query->where('is_sold', true);
                } else {
                    $query->where('is_sold', false);
                }
            }
        }
    }
}
