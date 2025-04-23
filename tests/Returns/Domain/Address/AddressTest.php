<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Address;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Address\Address;
use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertEquals;

class AddressTest extends TestCase
{
    public function test_it_can_be_created_from_snake_case_array(): void
    {
        $faker = Factory::create();

        $stub = [
            "street_1"             => $faker->streetName(),
            "street_2"             => null,
            "street_number"        => $faker->randomNumber(),
            "street_number_suffix" => $faker->word(),
            "postal_code"          => $faker->postcode(),
            "city"                 => $faker->city(),
            "state_code"           => $faker->countryCode(),
            "country_code"         => $faker->countryCode(),
            "company"              => $faker->company(),
            "first_name"           => $faker->firstName(),
            "last_name"            => $faker->lastName(),
            "email"                => $faker->email(),
            "phone_number"         => $faker->phoneNumber(),
        ];

        $address = Address::from($stub);

        assertEquals($address->street1, $stub['street_1']);
        assertEquals($address->street2, $stub['street_2']);
        assertEquals($address->streetNumber, $stub['street_number']);
        assertEquals($address->streetNumberSuffix, $stub['street_number_suffix']);
        assertEquals($address->postalCode, $stub['postal_code']);
        assertEquals($address->city, $stub['city']);
        assertEquals($address->stateCode, $stub['state_code']);
        assertEquals($address->countryCode, $stub['country_code']);
        assertEquals($address->company, $stub['company']);
        assertEquals($address->firstName, $stub['first_name']);
        assertEquals($address->lastName, $stub['last_name']);
        assertEquals($address->email, $stub['email']);
        assertEquals($address->phoneNumber, $stub['phone_number']);
    }
}
