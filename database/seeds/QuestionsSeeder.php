<?php

use Illuminate\Database\Seeder;

class QuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i < 20; $i++) {
            $question = \App\Question::create([
                'topic_id' => 3,
                'question_text' => 'question seed #'.($i + 40),
                'answer_explanation' => 'explanation #'.($i + 40),
                'code_snippet' => 'snippet #'.($i + 40),
            ]);

            for($y = 1; $y <= 5; $y++) {
                \App\QuestionsOption::create([
                    'option' => 'option #'.$y,
                    'correct' => rand(0, 1),
                    'question_id' => $question->id,
                ]);
            }
        }
    }
}
