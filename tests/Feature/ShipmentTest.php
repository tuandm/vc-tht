<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShipmentTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInvalidResponse()
    {
        $response = $this->get('/api/arrival-time-estimation');
        $response->assertStatus(405); // Method not allow
        $response = $this->post('/api/arrival-time-estimation');
        $response->assertStatus(302); // Redirect because headers doesn't contain application/json
    }

    /**
     * Tests to make sure the API covers invalid inputs
     */
    public function testInvalidInputDate()
    {
        $response = $this->json('POST', '/api/arrival-time-estimation');
        $response->assertStatus(422); // Invalid request - missing required params
        $response = $this->json('POST', '/api/arrival-time-estimation', ['shipment_left_time' => '']);
        $response->assertStatus(422); // Invalid request - invalid date
        $response = $this->json('POST', '/api/arrival-time-estimation', ['shipment_left_time' => 'Invalid']);
        $response->assertStatus(422); // Invalid request - invalid date
        $response = $this->json('POST', '/api/arrival-time-estimation', ['shipment_left_time' => '1960-11-16 12:00:00']);
        $response->assertStatus(422); // Invalid request - invalid date
    }

    /**
     * Valid tests
     *
     * @dataProvider datesProvider
     */
    public function testShipmentEstimation($leftTime, $expected)
    {
        $response = $this->json('POST', route('shipment.estimation'), ['shipment_left_time' => $leftTime]);
        $response->assertStatus(200);
        $result = $response->json('arrival_time');
        $this->assertEquals($expected, $result);
    }

    public function datesProvider()
    {
        return [
            [
                'left_time' => '2015-01-19 12:33:00',
                'expected' => '47-11-27 ∇ 15:01:36',
            ],
            [
                'left_time' => '2021-08-22 15:30:00 -0500',
                'expected' => '54-09-13 ∇ 05:22:09',
            ],
            [
                'left_time' => '1969-07-21 02:56:15',
                'expected' => '01-01-05 ∇ 01:31:33',
            ],
            [
                'left_time' => '1969-07-17 02:56:15',
                'expected' => '01-01-01 ∇ 00:00:00',
            ],
        ];
    }
}
