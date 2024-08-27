<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\Domain\Exception;

use App\Common\Domain\Exception\ResourceNotFound;

abstract class UserNotFound extends ResourceNotFound
{
}
