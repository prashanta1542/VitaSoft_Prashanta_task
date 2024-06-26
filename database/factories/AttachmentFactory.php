<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Attachment;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
{
    protected $model = Attachment::class;
    public function definition(): array
    {
        return [
            'attachable_id' => $this->faker->numberBetween(1, 50), // Assuming you have 50 attachable models
            'attachable_type' => $this->faker->randomElement([
                \App\Models\Product::class,
                ]),
            'file_path' => $this->faker->filePath(),
        ];
    }
}
