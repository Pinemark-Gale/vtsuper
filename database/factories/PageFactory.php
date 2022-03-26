<?php

namespace Database\Factories;

use App\Models\Page;
use App\Models\User;
use App\Models\PageStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::all()->random()->id,
            'page_status_id' => PageStatus::all()->random()->id,
            'title' => $this->faker->words(5, 'true'),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->words(50, 'true')
        ];
    }
}
