<?php

namespace Domain\User\Repositories;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class UserRepository implements UserRepositoryInterface
{
    public function __construct(
        private User $model
    ){}

    /**
     * @param int $id
     * @return Model
     */
    public function getById(int $id): Model
    {
        return $this->model->find($id);
    }

    /**
     * @param string $email
     * @return Model
     */
    public function getByEmail(string $email): Model
    {
        return $this->model->where('email', $email)->first();
    }

    /**
     * @param array $user
     * @return Model
     */
    public function create(array $user): Model
    {
        return $this->model->create($user);
    }

    /**
     * @param array $user
     * @return Model
     */
    public function update(array $user): Model
    {
        // TODO: Implement update() method.
    }
}
