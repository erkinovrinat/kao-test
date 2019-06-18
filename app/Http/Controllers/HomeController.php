<?php

namespace App\Http\Controllers;

use App\Charts\SampleChart;
use App\Http\Requests;
use App\Question;
use App\Result;
use App\Test;
use App\Topic;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::count();
        $users = User::whereNull('role_id')->count();
        $quizzes = Test::count();
        $average = Test::avg('result');
        $topics = Topic::all()->where('grade_id', Auth::user()->class);

        $usersForChart = User::all()->where('class', '<>', 0)
            ->groupBy('class')
            ->sortKeys()
            ->map(function ($item) {
                return $item->count();
            });

        $chart = new SampleChart();
        $chart->labels(['users', 'questions', 'quizzes']);
        $chart->dataset('dataset #1', 'line', [$users, $questions, $quizzes]);

        $chartUsers = new SampleChart();
        $chartUsers->labels($usersForChart->keys());
        $chartUsers->dataset('Ученики', 'line', $usersForChart->values())->options([
            'color' => '#ff0000',
        ]);

        return view('home', compact('questions', 'users', 'quizzes', 'average', 'topics', 'chart', 'chartUsers'));
    }
}
