<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingControllerTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * @test
     */
    function it_should_booking_inserted_request()
    {
        $room = Room::factory()->create();

        $request = [
            'room_id' => $room->id,
            'date' => $this->faker->date,
            'participants' => $this->faker->numberBetween(1,5),
        ];

        $response = $this->post('api/bookings', $request);

        $response->assertOk()->assertContent('"Booked successfully"');

        $this->assertDatabaseHas('bookings', [
            'book_date' => $request['date'],
            'room_id' => $request['room_id'],
            'participants' => $request['participants'],
        ]);
    }

    /**
     * @test
     */
    function it_should_show_room_bookings()
    {
        $room = Room::factory()->create();
        $user = User::factory()->create();

        $expected = [
            'book_date' => $this->faker->date,
            'room_id' => $room->id,
            'participants' => $this->faker->randomDigit(),
            'user_id' => $user->id
        ];

        Booking::factory()->create($expected);

        $response = $this->get("api/bookings/$room->id");

        $response->assertOk()->assertJson([$expected]);
    }

    /**
     * @test
     */
    function it_should_show_all_bookings()
    {
        $room = Room::factory()->create();
        $user = User::factory()->create();

        $expected = [
            'book_date' => $this->faker->date,
            'room_id' => $room->id,
            'participants' => $this->faker->randomDigit(),
            'user_id' => $user->id
        ];

        Booking::factory(2)->create($expected);

        $response = $this->get('api/bookings');

        $response->assertOk()->assertJson([$expected]);
    }
}
