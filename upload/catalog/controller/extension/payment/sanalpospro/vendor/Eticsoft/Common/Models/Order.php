<?php

namespace Eticsoft\Sanalpospro\Common\Models;

class Order extends Entity
{
    /** @var CartItem[] */
    private array $cart;
    private Shipping $shipping;
    private Invoice $invoice;

    public function __construct(
        ?array $cart = null,
        ?Shipping $shipping = null,
        ?Invoice $invoice = null
    ) {
        $this->cart = $cart ?? [];
        $this->shipping = $shipping ?? new Shipping();
        $this->invoice = $invoice ?? new Invoice();
    }

    public function getCart(): array
    {
        return $this->cart;
    }

    public function setCart(array $cart): void
    {
        $this->cart = $cart;
    }

    public function getShipping(): Shipping
    {
        return $this->shipping;
    }

    public function setShipping(Shipping $shipping): void
    {
        $this->shipping = $shipping;
    }

    public function getInvoice(): Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): void
    {
        $this->invoice = $invoice;
    }

    public function toArray(): array
    {
        return [
            'cart' => $this->cart,
            'shipping' => $this->shipping->toArray(),
            'invoice' => $this->invoice->toArray()
        ];
    }
}
