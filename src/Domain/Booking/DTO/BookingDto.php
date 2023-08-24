<?php

namespace Domain\Booking\DTO;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Infrastructure\DTO\BaseDto;

final class BookingDto extends BaseDto
{
    public ?string $date;
    public ?int $id;
    public int $userId;
    public int $roomId;
    public ?int $participants;

    public static function create(Request $request): BookingDto
    {
        $dto = new BookingDto();
        $dto->roomId = (int)$request->input('room_id');
        $dto->id = $request->input('id') ?? $request->id;
        $dto->participants = $request->input('participants');
        $dto->date = Carbon::createFromDate($request->input('date'))->toDateString();
        $dto->userId = Auth::user()->id;

        return $dto;
    }
}
