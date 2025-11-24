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
        User::firstOrCreate(
            ['email' => 'jperez@shub.com'],
            ['name' => 'Juan Pérez']
        );
        
        Survey::firstOrCreate(
            ['title' => 'old_satisfaction'],
            [
                'description' => 'Test Survey inactive',
                'is_active' => false,
            ]
        );
        
        $survey = Survey::firstOrCreate(
            ['title' => 'satisfaction'],
            [
                'description' => 'Test Survey active',
                'is_active' => true,
            ]
        );
        
        Question::firstOrCreate(
            [
                'survey_id' => $survey->id,
                'question_text' => "Your satisfaction between 0-5?",
            ],
            ['type' => 'text']
        );
    }
}
