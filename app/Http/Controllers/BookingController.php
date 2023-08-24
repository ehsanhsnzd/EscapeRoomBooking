<?php

namespace App\Http\Controllers;


use Domain\Booking\Actions\BookingAction;
use Domain\Booking\DTO\BookingDto;
use Domain\Booking\Repositories\BookingRepository;
use Domain\Booking\Requests\BookingRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends Controller
{

    public function __construct(
        private BookingRepository $bookingRepository,
        private BookingAction $bookingAction,
    ) {}

    /**
     * @param BookingRequest $request
     * @return JsonResponse
     */
    public function booking(BookingRequest $request)
    {
        try {
            $this->bookingAction->execute(BookingDto::create($request));

            return response()->json('Booked successfully');
        } catch (\Exception $exception){
            return response()->json(['message' => $exception->getMessage()], 500);
        }
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function cancel(Request $request)
    {
        return $this->bookingRepository->delete($request->id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->bookingRepository->all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        $dto = BookingDto::create($request);

        return $this->bookingRepository->get($dto);
    }

}
