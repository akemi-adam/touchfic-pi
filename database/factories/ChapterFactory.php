<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $content = fake()->paragraphs(random_int(1, 20), true);

        return [
            'title' => fake()->words(3, true),
            'authornotes' => fake()->paragraphs(1, true),
            'content' => $content,
            'numberofwords' => count(preg_split('~[^\p{L}\p{N}\']+~u', $content)),
        ];
    }
}
