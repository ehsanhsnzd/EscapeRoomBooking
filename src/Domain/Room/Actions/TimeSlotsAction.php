<?php

namespace Domain\Room\Actions;

use Domain\Room\Repositories\RoomRepository;
use Illuminate\Support\Collection;

final class TimeSlotsAction
{
    public function __construct(
        private RoomRepository $roomRepository,
    ) {}

    /**
     * @param int $id
     * @return Collection|null
     */
    public function execute(int $id): ?Collection
    {
        return $this->roomRepository
            ->bookingsById($id)
            ?->pluck('book_date');
    }
}
