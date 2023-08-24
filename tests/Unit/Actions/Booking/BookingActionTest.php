<?php

namespace Tests\Unit\Actions\Booking;

use App\Models\Room;
use App\Models\User;
use Carbon\Carbon;
use Domain\Booking\Actions\BookingAction;
use Domain\Booking\DTO\BookingDto;
use Domain\Booking\Repositories\BookingRepositoryInterface;
use Domain\Room\Repositories\RoomRepositoryInterface;
use Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\Suites\ServiceTestSuite;

/**
 * Class ProductServiceTest
 * @package Tests\Unit\Services
 * @coversDefaultClass \Domain\Booking\Actions\BookingAction
 */
class BookingActionTest extends ServiceTestSuite
{
    use WithFaker;

    private \PHPUnit\Framework\MockObject\MockObject|BookingAction $action;
    private UserRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject $userRepository;
    private RoomRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject $roomRepository;
    private BookingRepositoryInterface|\PHPUnit\Framework\MockObject\MockObject $bookingRepository;


    /**
     * @param array $methods
     * @return void
     * @throws \PHPUnit\Framework\MockObject\Exception
     */
    public function setService(array $methods = []): void
    {
        $this->userRepository = $this->createMock(UserRepositoryInterface::class);
        $this->bookingRepository = $this->createMock(BookingRepositoryInterface::class);
        $this->roomRepository = $this->createMock(RoomRepositoryInterface::class);
        $this->action = $this->getMockBuilder(BookingAction::class)
            ->onlyMethods($methods)
            ->setConstructorArgs([
                $this->userRepository,
                $this->bookingRepository,
                $this->roomRepository,
            ])
            ->getMock();
    }

    /**
     * @test
     * @covers ::execute
     * @covers ::__construct
     */
    public function it_should_store_book_within_data()
    {
        $this->setService();

        $room = Room::factory()->create();
        $bookingDto = $this->getBookingDTO();
        $bookingDto->roomId = $room->id;

        $this->action->execute($bookingDto);

        $this->assertDatabaseHas('bookings', [
            'book_date' => $bookingDto->date,
            'room_id' => $bookingDto->roomId,
            'user_id' => $bookingDto->userId,
            'participants' => $bookingDto->participants,
        ]);
    }

    /**
     * @test
     * @covers ::getBookingDiscount
     * @covers ::__construct
     */
    public function it_should_return_booking_discount_when_birthday()
    {
        $this->setService();

        Room::factory()->create();
        User::factory()->create(['birth_date' => Carbon::today()]);

        $bookingDto = $this->getBookingDTO();
        $expected = 10;

        $this->assertEquals($expected, $this->action->getBookingDiscount($bookingDto));
    }

    /**
     * @test
     * @covers ::getBookingFee
     * @covers ::__construct
     */
    public function it_should_return_booking_booking_fee()
    {
        $this->setService();

        $expected = 2000;
        $room = Room::factory()->create(['fee' => $expected]);
        $bookingDto = $this->getBookingDTO();
        $bookingDto->roomId = $room->id;

        $this->roomRepository
            ->expects($this->once())
            ->method('getById')
            ->willReturn($room);

        $this->action->getBookingFee($bookingDto);
    }

    public function getBookingDTO()
    {
        $dto = new BookingDto();
        $dto->roomId = $this->faker->randomDigit();
        $dto->participants = $this->faker->numberBetween(1,5);
        $dto->date = Carbon::today();
        $dto->userId = 1;

        return $dto;
    }
}
