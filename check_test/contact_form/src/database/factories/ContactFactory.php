<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Contact;
use App\Models\Category;

class ContactFactory extends Factory
{
    protected $model = Contact::class;
    protected static ?array $categoryIds = null;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        if (self::$categoryIds === null) {
            self::$categoryIds = Category::pluck('id')->toArray();
        }

        return [
            'category_id' => $this->faker->randomElement(self::$categoryIds),
            'last_name' => $this->faker->lastName(),
            'first_name' => $this->faker->firstName(),
            'gender' => $this->faker->numberBetween(1, 3),
            'email' => $this->faker->safeEmail(),
            'tel' => str_replace('-', '', $this->faker->phoneNumber()),
            'address' => $this->faker->city() . $this->faker->streetAddress(),
            'building' => $this->faker->secondaryAddress(),
            'detail' => $this->faker->realText(120),
        ];
    }
}
