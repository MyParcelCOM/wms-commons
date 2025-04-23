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

        assertEquals($stub['street_1'], $address->street1);
        assertEquals($stub['street_2'], $address->street2);
        assertEquals($stub['street_number'], $address->streetNumber);
        assertEquals($stub['street_number_suffix'], $address->streetNumberSuffix);
        assertEquals($stub['postal_code'], $address->postalCode);
        assertEquals($stub['city'], $address->city);
        assertEquals($stub['state_code'], $address->stateCode);
        assertEquals($stub['country_code'], $address->countryCode);
        assertEquals($stub['company'], $address->company);
        assertEquals($stub['first_name'], $address->firstName);
        assertEquals($stub['last_name'], $address->lastName);
        assertEquals($stub['email'], $address->email);
        assertEquals($stub['phone_number'], $address->phoneNumber);
    }
}
