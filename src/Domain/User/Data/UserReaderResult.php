<?php

namespace App\Domain\User\Data;

/**
 * DTO.
 */
final class UserReaderResult
{
    public ?int $id = null;

    public ?string $number = null;

    public ?string $name = null;

    public ?string $street = null;

    public ?string $postalCode = null;

    public ?string $city = null;

    public ?string $country = null;

    public ?string $email = null;
}
