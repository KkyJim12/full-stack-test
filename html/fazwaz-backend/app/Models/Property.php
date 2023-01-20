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

    public function province()
    {
        return $this->hasOne(Province::class, 'id', 'province_id');
    }

    public function scopeProvinces($query, $provinces)
    {
        $activeProvinces = explode(',', $provinces);

        if (count($activeProvinces) > 0) {
            $query->whereHas('province',  function ($query) use ($activeProvinces) {
                $query->whereIn('title', $activeProvinces);
            });
        } else {
            $query->whereHas('province',  function ($query) use ($activeProvinces) {
                $query->whereIn('title', []);
            });
        }
    }

    public function scopeStatus($query, $status)
    {
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
