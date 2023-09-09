<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomComplet' => $this->faker->name,
            'Email' => $this->faker->unique()->safeEmail,
            'telephone' => $this->faker->phoneNumber,
            'Salaire' => $this->faker->randomNumber(5),
        ];
    }
}
