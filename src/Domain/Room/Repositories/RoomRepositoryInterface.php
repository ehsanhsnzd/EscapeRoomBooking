<?php

namespace Domain\Room\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface RoomRepositoryInterface
{

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param int $id
     * @return Collection|null
     */
    public function getById(int $id): ?Model;

    /**
     * @param array $product
     * @return bool
     */
    public function create(array $product): bool;

    /**
     * @param array $product
     * @return bool
     */
    public function update(array $product): bool;
}
