<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        // Generate between 1 and 5 order items
        $itemCount  = $this->faker->numberBetween(1, 5);
        $orderItems = [];
        $subtotal   = 0;

        for ($i = 0; $i < $itemCount; $i++) {
            $quantity  = $this->faker->numberBetween(1, 10);
            $price     = $this->faker->numberBetween(10, 1000);
            $itemTotal = $quantity * $price;

            $orderItems[] = [
                'product_id' => $this->faker->numberBetween(1, 100),
                'name'       => $this->faker->word,
                'quantity'   => $quantity,
                'price'      => $price,
            ];

            $subtotal += $itemTotal;
        }

        // Calculate tax (10% of subtotal) and total
        $tax          = $subtotal * 0.1;
        $shippingCost = $this->faker->numberBetween(0, 50);
        $total        = $subtotal + $tax + $shippingCost;

        return [
            'order_number' => $this->faker->unique()->numberBetween(1000, 999999),
            'customer_details' => [
                'name'  => $this->faker->name,
                'email' => $this->faker->email,
                'phone' => $this->faker->phoneNumber,
            ],
            'order_date'        => $this->faker->date(),
            'attachment'        => $this->faker->optional()->word().'.pdf',
            'ordering_office'   => $this->faker->optional()->company,
            'ordering_officer'  => $this->faker->optional()->name,
            'order_items'       => $orderItems,
            'allow_shipping'    => $this->faker->randomElement(['Y', 'N']),
            'shipping_address'  => $this->faker->optional()->address,
            'shipping_method'   => $this->faker->optional()->randomElement(['standard', 'express', 'overnight']),
            'shipping_cost'     => $shippingCost,
            'status'            => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'subtotal'          => $subtotal,
            'tax'               => $tax,
            'total'             => $total,
            'payment_method'    => $this->faker->optional()->randomElement(['credit_card', 'bank_transfer', 'cash']),
            'payment_status'    => $this->faker->randomElement(['unpaid', 'paid', 'partially_paid', 'refunded']),
        ];
    }
}