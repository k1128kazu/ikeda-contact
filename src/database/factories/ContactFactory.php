<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class ContactFactory extends Factory
{
    public function definition()
    {
        return [

            'last_name'  => $this->faker->lastName,
            'first_name' => $this->faker->firstName,

            'gender'     => $this->faker->randomElement([1, 2, 3]),

            'email'      => $this->faker->unique()->safeEmail,

            'tel'        => $this->faker->numerify('090########'),

            'address'    => $this->faker->address,
            'building'   => $this->faker->optional()->secondaryAddress,

            // ▼ 実在する categories.id を取得
            'category_id' => Category::inRandomOrder()->value('id'),

            'detail'     => $this->faker->realText(80),

            // ▼ created_at を「過去30日以内」に散らす
            'created_at' => $this->faker->dateTimeBetween('-30 days', 'now'),
        ];
    }
}
