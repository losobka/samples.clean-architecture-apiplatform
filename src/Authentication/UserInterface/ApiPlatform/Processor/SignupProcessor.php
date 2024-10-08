<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\UserInterface\ApiPlatform\Processor;

use Override;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use App\Authentication\Application\DTO\AuthTokenDTO;
use App\Authentication\Application\UseCase\Signup\SignupCommand;
use App\Authentication\UserInterface\ApiPlatform\Output\JWT;
use App\Authentication\UserInterface\ApiPlatform\Payload\Signup;
use App\Common\Application\Command\CommandBus;
use Webmozart\Assert\Assert;

final readonly class SignupProcessor implements ProcessorInterface
{
    public function __construct(
        private CommandBus $commandBus,
    ) {
    }

    #[Override]
    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): JWT
    {
        Assert::isInstanceOf($data, Signup::class);

        /** @var Signup $signupPayload */
        $signupPayload = $data;

        $authToken = $this->signup($signupPayload);

        return JWT::fromAuthTokenDTO($authToken);
    }

    private function signup(Signup $signupPayload): AuthTokenDTO
    {
        return $this->commandBus
            ->dispatch(
                new SignupCommand(
                    firstName: $signupPayload->firstName,
                    lastName: $signupPayload->lastName,
                    email: $signupPayload->email,
                    password: $signupPayload->password,
                    passwordConfirm: $signupPayload->passwordConfirm,
                )
            );
    }
}
