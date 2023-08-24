<?php

namespace Domain\Room\Repositories;

use App\Models\Room;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class RoomRepository implements RoomRepositoryInterface
{
    public function __construct(
        private Room $model
    ){}

    /**
     * @param int $id
     * @return Collection|null
     */
    public function getById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->all();
    }

    /**
     * @param int $id
     * @return Collection|null
     */
    public function bookingsById(int $id): ?Collection
    {
        return $this->model->find($id)?->bookings()->get();
    }

    /**
     * @param array $product
     * @return bool
     */
    public function create(array $product): bool
    {
        // TODO: Implement create() method.
    }

    /**
     * @param array $product
     * @return bool
     */
    public function update(array $product): bool
    {
        // TODO: Implement update() method.
    }
}
