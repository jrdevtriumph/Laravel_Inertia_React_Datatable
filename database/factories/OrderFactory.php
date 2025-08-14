<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
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
            'order_items' => [
                [
                    'product_id' => $this->faker->numberBetween(1, 100),
                    'name'       => $this->faker->word,
                    'quantity'   => $this->faker->numberBetween(1, 10),
                    'price'      => $this->faker->numberBetween(10, 1000),
                ]
            ],
            'allow_shipping'    => $this->faker->randomElement(['Y', 'N']),
            'shipping_address'  => $this->faker->optional()->address,
            'shipping_method'   => $this->faker->optional()->randomElement(['standard', 'express', 'overnight']),
            'shipping_cost'     => $this->faker->numberBetween(0, 50),
            'status'            => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
            'subtotal'          => $this->faker->numberBetween(100, 10000),
            'tax'               => $this->faker->numberBetween(0, 1000),
            'total'             => $this->faker->numberBetween(100, 11000),
            'payment_method'    => $this->faker->optional()->randomElement(['credit_card', 'bank_transfer', 'cash']),
            'payment_status'    => $this->faker->randomElement(['unpaid', 'paid', 'partially_paid', 'refunded']),
        ];
    }
}