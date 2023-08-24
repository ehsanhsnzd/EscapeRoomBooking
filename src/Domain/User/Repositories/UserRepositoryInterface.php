<?php

namespace Domain\User\Repositories;


use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface UserRepositoryInterface
{

    /**
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model;

    /**
     * @param string $email
     * @return Model
     */
    public function getByEmail(string $email): Model;

    /**
     * @param array $user
     * @return Model
     */
    public function create(array $user): Model;

    /**
     * @param array $user
     * @return Model
     */
    public function update(array $user): Model;
}
