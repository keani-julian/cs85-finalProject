<?php

namespace Database\Factories;

use App\Models\Submission;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Submission>
 */
class SubmissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'document_type' => fake()->randomElement(array_keys(Submission::DOCUMENT_TYPES)),
            'target_role' => fake()->jobTitle(),
            'mode' => fake()->randomElement(array_keys(Submission::MODES)),
            'input_text' => fake()->paragraphs(3, true),
            'ai_output' => fake()->paragraphs(4, true),
        ];
    }
}
