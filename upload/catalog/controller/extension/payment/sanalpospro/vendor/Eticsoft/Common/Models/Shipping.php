<?php

namespace Eticsoft\Sanalpospro\Common\Models;

class Shipping
{
    private string $first_name;
    private string $last_name;
    private string $phone;
    private string $email;
    private Address $address;
    
    public function __construct(
        ?string $firstName = '',
        ?string $lastName = '',
        ?string $phone = '',
        ?string $email = '',
        ?Address $address = null
    ) {
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->phone = $phone;
        $this->email = $email;
        $this->address = $address ?? new Address();
    }


    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function setFirstName(string $firstName): void
    {
        $this->first_name = $firstName;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }

    public function setLastName(string $lastName): void
    {
        $this->last_name = $lastName;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }


    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address->toArray(),
        ];
    }
}
