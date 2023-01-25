<?php

namespace Tests\Unit;

use Tests\TestCase;

class PropertyTest extends TestCase
{

    /**  Test scenarios
     *   1.With out any query strings
     *   2.With only limit and page
     *   3.With status
     *   4.With search
     *   5.With provinces
     */

    public function test_get_properties_with_out_filters()
    {
        $response = $this->get('/api/v1/properties')->assertStatus(200);
        $properties = $response->decodeResponseJson()['data'];

        $this->assertCount(25, $properties);
    }

    public function test_get_properties_with_only_limit()
    {
        $response = $this->get('/api/v1/properties?page=1&limit=1000')->assertStatus(200);
        $properties = $response->decodeResponseJson()['data'];

        $this->assertCount(200, $properties);
    }

    public function test_get_properties_filtered_by_status_sales()
    {
        $response = $this->get('/api/v1/properties?status=Sale')->assertStatus(200);
        $properties = $response->decodeResponseJson()['data'];

        foreach ($properties as $property) {
            $this->assertTrue($property['for_sale']);
        }
    }

    public function test_get_properties_filtered_by_status_sold()
    {
        $response = $this->get('/api/v1/properties?status=Sold')->assertStatus(200);
        $properties = $response->decodeResponseJson()['data'];

        foreach ($properties as $property) {
            $this->assertTrue($property['is_sold']);
        }
    }

    public function test_get_properties_filtered_by_status_all()
    {
        $response = $this->get('/api/v1/properties?status=Sale,Sold&page=1&limit=1000')->assertStatus(200);
        $properties = $response->decodeResponseJson()['data'];

        $this->assertCount(200, $properties);
    }

    public function test_get_properties_filtered_by_search()
    {
        $strings = ['Condo', 'Villa', 'Apartment'];

        foreach ($strings as $string) {
            $response = $this->get('/api/v1/properties?search=' . $string)->assertStatus(200);
            $properties = $response->decodeResponseJson()['data'];

            foreach ($properties as $property) {
                $this->assertStringContainsString($string, $property['title']);
            }
        }
    }

    public function test_get_properties_filtered_by_provicnes()
    {
        $provinces = ['Samut Prakan', 'Phuket', 'Bangkok', 'Chiang Mai', 'Chon Buri', 'Surat Thaini'];

        foreach ($provinces as $province) {
            $response = $this->get('/api/v1/properties?search=' . $province)->assertStatus(200);
            $properties = $response->decodeResponseJson()['data'];

            foreach ($properties as $property) {
                $this->assertStringContainsString($province, $property['province']['title']);
            }
        }
    }
}
