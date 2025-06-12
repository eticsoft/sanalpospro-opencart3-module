<?php

namespace Eticsoft\Sanalpospro\Common\Models;

class Cart extends Entity
{
    /** @var CartItem[] */
    private array $items;

    public function __construct()
    {
        $this->items = [];
    }

    public function addItem(CartItem $item): void
    {
        $this->items[] = $item;
    }

    public function removeItem(string $itemId): void
    {
        foreach ($this->items as $key => $item) {
            if ($item->getId() === $itemId) {
                unset($this->items[$key]);
                break;
            }
        }
        // Reindex array after removal
        $this->items = array_values($this->items);
    }

    /**
     * @return CartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param CartItem[] $items
     */
    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    public function getItemCount(): int
    {
        return count($this->items);
    }

    public function getTotalPrice(): float
    {
        $total = 0.0;
        foreach ($this->items as $item) {
            $total += $item->getPrice() * $item->getQuantity();
        }
        return $total;
    }

    public function clear(): void
    {
        $this->items = [];
    }

    public function toArray(): array
    {
        $items = [];
        foreach ($this->items as $item) {
            $items[] = $item->toArray();
        }
        return [
            'items' => $items,
            'total_price' => $this->getTotalPrice(),
            'item_count' => $this->getItemCount()
        ];
    }
}
