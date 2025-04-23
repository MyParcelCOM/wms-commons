<?php

declare(strict_types=1);

namespace Tests\Returns\Domain\Address;

use Faker\Factory;
use MyParcelCom\Wms\Returns\Domain\Address\Address;
use PHPUnit\Framework\TestCase;

class AddressTest extends TestCase
{
    public function test_it_can_be_created_from_snake_case_array(): void
    {
        $faker = Factory::create();

        $stub = [
            "street_1" => $faker->streetName(),
            "street_2" => null,
            "street_number" => $faker->randomNumber(),
            "street_number_suffix" => $faker->word(),
            "postal_code" => $faker->postcode(),
            "city" => $faker->city(),
            "state_code" => $faker->countryCode(),
            "country_code" => $faker->countryCode(),
            "company" => $faker->company(),
            "first_name" => $faker->firstName(),
            "last_name" => $faker->lastName(),
            "email" => $faker->email(),
            "phone_number" => $faker->phoneNumber(),
        ];

        $address = Address::from($stub);

        $this->assertEquals($address->street1, $stub['street_1']);
        $this->assertEquals($address->street2, $stub['street_2']);
        $this->assertEquals($address->streetNumber, $stub['street_number']);
        $this->assertEquals($address->streetNumberSuffix, $stub['street_number_suffix']);
        $this->assertEquals($address->postalCode, $stub['postal_code']);
        $this->assertEquals($address->city, $stub['city']);
        $this->assertEquals($address->stateCode, $stub['state_code']);
        $this->assertEquals($address->countryCode, $stub['country_code']);
        $this->assertEquals($address->company, $stub['company']);
        $this->assertEquals($address->firstName, $stub['first_name']);
        $this->assertEquals($address->lastName, $stub['last_name']);
        $this->assertEquals($address->email, $stub['email']);
        $this->assertEquals($address->phoneNumber, $stub['phone_number']);

    }
}
