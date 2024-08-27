<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Messaging\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValue;
use App\User\Application\DTO\UserDTO;

final class ParticipantName extends StringValue
{
    public static function fromUserDTO(UserDTO $userDTO): ParticipantName
    {
        return self::fromString($userDTO->firstName . ' ' . $userDTO->lastName);
    }
}
