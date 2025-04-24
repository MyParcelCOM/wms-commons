<?php

declare(strict_types=1);

namespace MyParcelCom\Wms\Returns\Domain\Address;

class Address
{
    public function __construct(
        public string $street1,
        public ?string $street2,
        public ?int $streetNumber,
        public ?string $streetNumberSuffix,
        public ?string $postalCode,
        public string $city,
        public ?string $stateCode,
        public string $countryCode,
        public ?string $company,
        public string $firstName,
        public string $lastName,
        public ?string $email,
        public ?string $phoneNumber,
    ) {
    }

    public static function from(array $data): self
    {
        return new self(
            street1: $data['street_1'],
            street2: $data['street_2'] ?? null,
            streetNumber: $data['street_number'] ?? null,
            streetNumberSuffix: $data['street_number_suffix'] ?? null,
            postalCode: $data['postal_code'] ?? null,
            city: $data['city'] ?? null,
            stateCode: $data['state_code'] ?? null,
            countryCode: $data['country_code'] ?? null,
            company: $data['company'] ?? null,
            firstName: $data['first_name'] ?? null,
            lastName: $data['last_name'] ?? null,
            email: $data['email'] ?? null,
            phoneNumber: $data['phone_number'] ?? null,
        );
    }

}
