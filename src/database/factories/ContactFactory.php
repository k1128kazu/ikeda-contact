<?php

namespace Database\Factories;

use App\Models\Contact;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition()
    {
        // categories.id は 16〜20 に固定
        $categoryId = $this->faker->randomElement([16, 17, 18, 19, 20]);

        // created_at：過去30日以内に分散
        $createdAt = $this->faker->dateTimeBetween('-30 days', 'now');

        return [
            'last_name'   => $this->faker->lastName(),
            'first_name'  => $this->faker->firstName(),
            'gender'      => $this->faker->randomElement([1, 2, 3]),
            'email'       => $this->faker->unique()->safeEmail(),

            // tel：ハイフンなし
            'tel'         => '090' . $this->faker->numerify('########'),

            'address'     => $this->faker->address(),
            'building'    => $this->faker->optional()->secondaryAddress(),

            'category_id' => $categoryId,

            // 仕様：120文字以内
            'detail'      => $this->faker->realText(120),

            // 分散日付を反映
            'created_at'  => $createdAt,
            'updated_at'  => $createdAt,
        ];
    }
}
