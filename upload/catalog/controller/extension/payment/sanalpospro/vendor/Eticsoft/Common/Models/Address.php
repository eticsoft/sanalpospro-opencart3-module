<?php

namespace Eticsoft\Sanalpospro\Common\Models;

class Address extends Entity
{
    private string $line1;
    private ?string $line2;
    private string $city;
    private string $state;
    private string $postalCode;
    private string $country;

    public function __construct(
        ?string $line1 = '',
        ?string $city = '',
        ?string $state = '',
        ?string $postalCode = '',
        ?string $country = '',
        ?string $line2 = null
    ) {
        $this->line1 = $line1;
        $this->line2 = $line2;
        $this->city = $city;
        $this->state = $state;
        $this->postalCode = $postalCode;
        $this->country = $country;
    }

    public function getLine1(): string
    {
        return $this->line1;
    }

    public function setLine1(string $line1): void
    {
        $this->line1 = $line1;
    }

    public function getLine2(): ?string
    {
        return $this->line2;
    }

    public function setLine2(?string $line2): void
    {
        $this->line2 = $line2;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getPostalCode(): string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): void
    {
        $this->postalCode = $postalCode;
    }

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): void
    {
        $this->country = $country;
    }

    public function toArray(): array
    {
        $data = [
            'line_1' => $this->line1,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postalCode,
            'country' => $this->country
        ];

        if ($this->line2 !== null) {
            $data['line_2'] = $this->line2;
        }

        return $data;
    }
}
