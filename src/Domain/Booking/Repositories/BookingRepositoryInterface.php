<?php

namespace Domain\Booking\Repositories;


use Domain\Booking\DTO\BookingDto;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\DTO\BaseDto;

interface BookingRepositoryInterface
{

    /**
     * @param BaseDto $dto
     * @return Collection|null
     */
    public function get(BaseDto $dto): ?Collection;

    /**
     * @param BookingDto $dto
     * @return Model|null
     */
    public function find(BookingDto $dto): ?Model;

    /**
     * @return Collection
     */
    public function all(): Collection;

    /**
     * @param array $booking
     * @return Collection
     */
    public function create(array $booking): Collection;

    /**
     * @param array $booking
     * @return bool
     */
    public function update(array $booking): bool;

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool;
}
