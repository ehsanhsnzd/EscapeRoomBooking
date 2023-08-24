<?php

namespace Domain\Booking\Actions;

use App\Models\Booking;
use Carbon\Carbon;
use Domain\Booking\DTO\BookingDto;
use Domain\Booking\Enums\BookingConfig;
use Domain\Booking\Repositories\BookingRepositoryInterface;
use Domain\Room\Repositories\RoomRepositoryInterface;
use Domain\User\Repositories\UserRepositoryInterface;

class BookingAction
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private BookingRepositoryInterface $bookingRepository,
        private RoomRepositoryInterface $roomRepository,
    ) {}

    public function execute(BookingDto $bookingDto)
    {
        $booking = $this->bookingRepository->find($bookingDto) ?: new Booking();
        $booking->user_id = $bookingDto->userId;
        $booking->room_id = $bookingDto->roomId;
        $booking->book_date = $bookingDto->date;
        $booking->fee = $this->getBookingFee($bookingDto);
        $booking->participants = $this->getParticipants($bookingDto);
        $booking->discount = $this->getBookingDiscount($bookingDto);

        $booking->save();
    }

    /**
     * @param BookingDto $bookingDto
     * @return int
     */
    public function getBookingDiscount(BookingDto $bookingDto): int
    {
        $user = $this->userRepository->getById($bookingDto->userId);

        $bookDate = Carbon::createFromDate($bookingDto->date);

        if ($bookDate->isSameDay($user->birth_date) && $bookDate->isSameMonth($user->birth_date)) {
            return BookingConfig::DISCOUNT;
        }

        return 0;
    }

    /**
     * @param BookingDto $bookingDto
     * @return int|null
     */
    public function getBookingFee(BookingDto $bookingDto): ?int
    {
        $fee = $this->roomRepository->getById($bookingDto->roomId)?->fee;

        return $fee - ($fee * ($this->getBookingDiscount($bookingDto) / 100));
    }

    /**
     * @param BookingDto $bookingDto
     * @return int|null
     * @throws \Exception
     */
    private function getParticipants(BookingDto $bookingDto): ?int
    {
        $participants = $this->roomRepository->getById(
            $bookingDto->roomId
        )?->participants;

        if ($participants && $participants < $bookingDto->participants){
            throw new \Exception('Participants can not be more than occupancy');
        }

        return $bookingDto->participants;
    }
}
