@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if(Auth::user()->role_id == 1)
                <div class="panel panel-default">
                    <div class="panel-heading">Добро пожаловать в центр тестирования!</div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <h1>{{ $questions }}</h1>
                                всего вопросов в базе данных
                            </div>
                            <div class="col-md-3 text-center">
                                <h1>{{ $users }}</h1>
                                зарегистрировано учащихся
                            </div>
                            <div class="col-md-3 text-center">
                                <h1>{{ $quizzes }}</h1>
                                пройдено тестов
                            </div>
                            <div class="col-md-3 text-center">
                                <h1>{{ number_format($average, 2) }} / 10</h1>
                                общая средняя оценка
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="col-12">
                {!! $chartUsers->container() !!}
            </div>

            @foreach($topics as $topic)
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $topic->title }}</div>
                    <div class="panel-body">
                        <a href="{{ route('tests.index', ['id' => $topic->id]) }}" class="btn btn-success">Пройти тест</a>
                    </div>
                </div>
            @endforeach

{{--            <a href="{{ route('tests.index') }}" class="btn btn-success">Take a new quiz!</a>--}}
        </div>
    </div>
@endsection

@section('javascript')
    {!! $chartUsers->script() !!}
@stop
