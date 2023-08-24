<?php


namespace App\Http\Controllers;


use Domain\User\Actions\LoginAction;
use Domain\User\Actions\RegisterAction;
use Domain\User\Requests\RegisterUser;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class UserController
{

    public function __construct(
        private LoginAction $loginAction,
        private RegisterAction $registerAction,
    ) {}

    /**
     * @param Request $request
     * @return mixed
     * @throws ValidationException
     */
    public function login(Request $request)
    {
        return $this->loginAction->execute($request);
    }

    /**
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUser $request)
    {
        $this->registerAction->execute($request);

        return response()->json('successfully registered');
    }

}
