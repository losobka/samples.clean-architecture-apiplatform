<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\User\UserInterface\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiProperty;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use App\User\Application\DTO\UserDTO;
use App\User\UserInterface\ApiPlatform\Processor\CreateUserProcessor;
use App\User\UserInterface\ApiPlatform\Provider\UserProvider;
use App\User\UserInterface\ApiPlatform\Provider\UsersProvider;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ApiResource(
    shortName: 'User',
    operations: [
        new GetCollection(
            openapi: new Operation(summary: 'Search users'),
            provider: UsersProvider::class,
        ),
        new Get(
            openapi: new Operation(summary: 'Get user'),
            provider: UserProvider::class,
        ),
        new Post(
            inputFormats: ['json' => 'application/json'],
            openapi: new Operation(summary: 'Create user'),
            denormalizationContext: ['groups' => ['create']],
            validationContext: ['groups' => ['create']],
            processor: CreateUserProcessor::class,
        ),
    ],
)]
final readonly class UserResource
{
    public function __construct(
        #[ApiProperty(readable: true, writable: false, identifier: true)]
        #[Groups(groups: ['read'])]
        public string $id = '',

        #[Assert\Length(min: 1, max: 255)]
        #[Assert\NotNull(groups: ['register', 'create'])]
        #[Groups(groups: ['read', 'create'])]
        public string $firstName = '',

        #[Assert\Length(min: 1, max: 255)]
        #[Assert\NotNull(groups: ['register', 'create'])]
        #[Groups(groups: ['read', 'create'])]
        public string $lastName = '',

        #[Assert\Length(min: 1, max: 255)]
        #[Assert\Email]
        #[Assert\NotNull(groups: ['register', 'create'])]
        #[Groups(groups: ['read', 'create'])]
        public string $email = '',
    ) {
    }

    public static function fromUserDTO(UserDTO $userDTO): UserResource
    {
        return new self(
            id: $userDTO->id,
            firstName: $userDTO->firstName,
            lastName: $userDTO->lastName,
            email: $userDTO->email,
        );
    }
}
