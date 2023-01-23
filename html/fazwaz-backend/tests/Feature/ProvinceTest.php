<?php

namespace Tests\Feature;

use App\Models\Province;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProvinceTest extends TestCase
{


    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_laravel_is_running()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**  Test scenarios
     *   1. Normal request
     */

    public function test_get_provinces()
    {
        $response = $this->get('/api/v1/provinces');
        $response->assertStatus(200);
    }

    /**  Test scenarios
     *   1. With out query strings
     *   2. With 0 value query strings (null, '', undefined)
     *   3. With normal query strings
     *   4. With some query strings
     *   5. With wrong type of query strings
     */

    public function test_get_properties()
    {
        $status = ['Sale', 'Sold'];
        $provinces = Province::pluck('title');
        $limit = ['10', '25', '50', '100'];
        // $sort = ['price-low-to-high', 'price-high-to-low', 'title-a-to-z', 'title-z-to-a'];
        // $search = ['a', 'b', 'c'];

        $test_requests = [];

        for ($a = 0; $a < count($status); $a++) {
            for ($b = 0; $b < count($provinces); $b++) {
                for ($c = 0; $c < count($limit); $c++) {
                    $merge = ['status' => $status[$a], 'provinces' => $provinces[$b], 'limit' => $limit[$c]];
                    array_push($test_requests, $merge);
                }
            }
        }

        for ($i = 0; $i < count($test_requests); $i++) {
            $response = $this->call(
                'GET',
                '/api/v1/properties',
                [
                    'status' => $test_requests[$i]['status'],
                    'provinces' => $test_requests[$i]['provinces'],
                    'limit' => $test_requests[$i]['limit'],
                    'sort' => 'price-low-to-high',
                    'search' => '',
                ]
            );
            $response->assertStatus(200);
        }
    }
}
