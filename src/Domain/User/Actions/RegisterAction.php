<?php


namespace Domain\User\Actions;


use Carbon\Carbon;
use Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

final class RegisterAction
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {}

    public function execute(Request $request)
    {
        return $this->userRepository->create([
            'name' => $request->name,
            'email' => $request->email,
            'birth_date' => Carbon::createFromDate($request->birth_date)->toDateString(),
            'password' => Hash::make($request->password)
        ]);
    }
}
