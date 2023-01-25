<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Province;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use File;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = File::get('database/data/properties.json');
        $properties =  json_decode($data, true);

        foreach ($properties as $property) {
            $province = Province::firstOrCreate([
                'country' => $property['geo']['country'],
                'title' => $property['geo']['province']
            ]);

            Property::create([
                'title' => $property['title'],
                'description' => $property['description'],
                'for_sale' => $property['for_sale'],
                'for_rent' => $property['for_rent'],
                'is_sold' => $property['sold'],
                'price' => $property['price'],
                'currency' => $property['currency'],
                'currency_symbol' => $property['currency_symbol'],
                'property_type' => $property['property_type'],
                'bedrooms' => $property['bedrooms'],
                'bathrooms' => $property['bathrooms'],
                'area' => $property['area'],
                'area_type' => $property['area_type'],
                'photo_thumb' => $property['photos']['thumb'],
                'photo_search' => $property['photos']['search'],
                'photo_full' => $property['photos']['full'],
                'street' => $property['geo']['street'],
                'province_id' => $province->id,
            ]);
        }
    }
}
