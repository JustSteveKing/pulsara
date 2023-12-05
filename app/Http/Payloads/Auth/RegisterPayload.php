<?php

declare(strict_types=1);

namespace App\Http\Payloads\Auth;

final readonly class RegisterPayload
{
    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $password
     */
    public function __construct(
        private string $firstName,
        private string $lastName,
        private string $email,
        private string $password,
    ) {}

    /**
     * @return array{
     *     first_name:string,
     *     last_name:string,
     *     email:string,
     *     password:string,
     * }
     */
    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }
}
