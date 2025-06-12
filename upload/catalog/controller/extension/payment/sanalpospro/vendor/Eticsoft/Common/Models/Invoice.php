<?php

namespace Eticsoft\Sanalpospro\Common\Models;

class Invoice extends Entity
{
    private string $id;
    private string $first_name;
    private string $last_name;
    private float $price;
    private int $quantity;

    public function __construct(
        ?string $firstName = '',
        ?string $lastName = '',
        ?float $price = 0.0,
        ?int $quantity = 1,
        ?string $id = null
    ) {
        $this->id = $id ?? (string) rand(1000, 9999);
        $this->first_name = $firstName;
        $this->last_name = $lastName;
        $this->price = $price;
        $this->quantity = $quantity;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): void
    {
        $this->id = $id;
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

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'price' => $this->price,
            'quantity' => $this->quantity
        ];
    }
}
