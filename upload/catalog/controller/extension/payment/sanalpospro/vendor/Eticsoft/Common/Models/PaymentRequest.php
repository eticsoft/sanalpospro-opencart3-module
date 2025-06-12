<?php

namespace Eticsoft\Sanalpospro\Common\Models;


class PaymentRequest extends Entity
{
    private PaymentModel $payment;
    private Payer $payer;
    private Order $order;

    public function __construct(
        ?PaymentModel $payment = null,
        ?Payer $payer = null,
        ?Order $order = null
    ) {
        $this->payment = $payment ?? new PaymentModel();
        $this->payer = $payer ?? new Payer();
        $this->order = $order ?? new Order();
    }

    public function getPayment(): PaymentModel
    {
        return $this->payment;
    }

    public function setPayment(PaymentModel $payment): void
    {
        $this->payment = $payment;
    }

    public function getPayer(): Payer
    {
        return $this->payer;
    }

    public function setPayer(Payer $payer): void
    {
        $this->payer = $payer;
    }

    public function getOrder(): Order
    {
        return $this->order;
    }

    public function setOrder(Order $order): void
    {
        $this->order = $order;
    }

    public function toArray(): array
    {
        return [
            'payment' => $this->payment->toArray(),
            'payer' => $this->payer->toArray(),
            'order' => $this->order->toArray()
        ];
    }
}
