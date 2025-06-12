<?php

namespace Eticsoft\Sanalpospro\Common\Models;


class Payer extends Entity
{
    private string $first_name;
    private string $last_name;
    private string $email;
    private string $phone;
    private Address $address;
    private string $ip;

    public function __construct(
        ?string $firstname = '',
        ?string $lastname = '',
        ?string $email = '',
        ?string $phone = '',
        ?Address $address = null,
        ?string $ip = ''
    ) {
        $this->first_name = $firstname;
        $this->last_name = $lastname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address ?? new Address();
        $this->ip = $ip;
    }

    public function getFirstname(): string
    {
        return $this->first_name;
    }

    public function setFirstname(string $firstname): void
    {
        $this->first_name = $firstname;
    }

    public function getLastname(): string
    {
        return $this->last_name;
    }

    public function setLastname(string $lastname): void
    {
        $this->last_name = $lastname;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getPhone(): string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): void
    {
        $this->address = $address;
    }

    public function getIp(): string
    {
        return $this->ip;
    }

    public function setIp(string $ip): void
    {
        $this->ip = $ip;
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'address' => $this->address->toArray(),
            'ip' => $this->ip
        ];
    }
}
