<?php

namespace Database\Factories;

use App\Models\Resource;
use App\Models\ResourceType;
use App\Models\Source;
use Illuminate\Database\Eloquent\Factories\Factory;

class ResourceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Resource::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'resource_type_id' => ResourceType::all()->random()->id,
            'source_id' => Source::all()->random()->id,
            'name' => $this->faker->sentence(),
            'link' => $this->faker->url(),
            'description' => $this->faker->paragraph()
        ];
    }
}
