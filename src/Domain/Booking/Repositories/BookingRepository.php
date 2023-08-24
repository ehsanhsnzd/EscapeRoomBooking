<?php

namespace Domain\Booking\Repositories;

use App\Models\Booking;
use Domain\Booking\DTO\BookingDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\DTO\BaseDto;

class BookingRepository implements BookingRepositoryInterface
{
    public function __construct(
        private Booking $model
    ){}

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param BookingDto $dto
     * @return Model|null
     */
    public function find(BookingDto $dto): ?Model
    {
        return $this->model
            ->where('room_id', $dto->roomId)
            ->where('user_id', $dto->userId)
            ->first();
    }

    /**
     * @param BaseDto $dto
     * @return Collection|null
     */
    public function get(BaseDto $dto): ?Collection
    {
        if (!$dto->id) {
            return null;
        }

        return $this->model->where('room_id', $dto->id)->get();
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }

    /**
     * @param array $booking
     * @return Collection
     */
    public function create(array $booking): Collection
    {
        return $this->model->create($booking);
    }

    /**
     * @param array $booking
     * @return bool
     */
    public function update(array $booking): bool
    {
        // TODO: Implement update() method.
    }
}
