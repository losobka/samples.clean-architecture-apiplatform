<?php

declare(strict_types=1);

/*
 * webapp.api
 *
 * (c) 2024 Łukasz Osóbka
 */

namespace App\Authentication\UserInterface\ApiPlatform\Resource;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Post;
use ApiPlatform\OpenApi\Model\Operation;
use ApiPlatform\OpenApi\Model\Response;
use App\Authentication\UserInterface\ApiPlatform\Output\JWT;
use App\Authentication\UserInterface\ApiPlatform\Payload\Login;
use App\Authentication\UserInterface\ApiPlatform\Payload\Signup;
use App\Authentication\UserInterface\ApiPlatform\Processor\LoginProcessor;
use App\Authentication\UserInterface\ApiPlatform\Processor\SignupProcessor;

#[ApiResource(
    shortName: 'Authentication',
    operations: [
        new Post(
            '/login',
            inputFormats: ['json' => 'application/json'],
            openapi: new Operation(responses: [201 => new Response(description:  'Login successful')], summary: 'Login', description: 'Authenticates a user'),
            validationContext: ['groups' => ['login']],
            input: Login::class,
            output: JWT::class,
            processor: LoginProcessor::class,
        ),
        new Post(
            '/signup',
            inputFormats: ['json' => 'application/json'],
            openapi: new Operation(summary: 'Signup'),
            validationContext: ['groups' => ['create', 'signup']],
            input: Signup::class,
            output: JWT::class,
            processor: SignupProcessor::class,
        ),
    ],
    routePrefix: '/auth',
)]
final class Authentication
{
}
