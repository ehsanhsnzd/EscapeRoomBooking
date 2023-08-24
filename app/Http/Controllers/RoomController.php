<?php


namespace App\Http\Controllers;


use Domain\Room\Actions\TimeSlotsAction;
use Domain\Room\Repositories\RoomRepository;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function __construct(
        private RoomRepository $roomRepository,
        private TimeSlotsAction $timeSlotsAction,
    ) {}

    /**
     * @param Request $request
     * @return mixed
     */
    public function get(Request $request)
    {
        return $this->roomRepository->getById((int)$request->id);
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->roomRepository->all();
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getTimeSlots(Request $request)
    {
        return $this->timeSlotsAction->execute($request->id);
    }
}
