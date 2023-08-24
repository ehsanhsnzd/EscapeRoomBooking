<?php


namespace Domain\User\Actions;


use Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

final class LoginAction
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function execute(Request $request)
    {
        $user = $this->userRepository->getByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']]);
        }

        return $user->createToken($request->device_name)->plainTextToken;
    }
}
