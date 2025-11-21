<?php

namespace Database\Seeders;

use App\Models\Question;
use App\Models\Survey;
use App\Models\User;
use Illuminate\Database\Seeder;

class CreateTestData extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Juan Pérez',
            'email' => 'jperez@shub.com',
        ]);
        Survey::create([
            'title' => 'old_satisfaction',
            'description' => 'Test Survey inactive',
            'is_active' => false,
        ]);
        $survey = Survey::create([
            'title' => 'satisfaction',
            'description' => 'Test Survey active',
            'is_active' => true,
        ]);
        $question = new Question(["question_text" => "Your satisfaction between 0-5?", "type" => "text"]);
        $survey->questions()->save($question);

    }
}
