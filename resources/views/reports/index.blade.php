@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('reports.index') }}">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>
                            Регионы
                            <select name="oblast_id" class="form-control" id="oblast">
                                <option value="{{ null }}">Выберите регион...</option>
                                @foreach($oblasts as $oblast)
                                    <option value="{{ $oblast->id }}">{{ $oblast->name }}</option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Районы
                            <select name="region_id" class="form-control" id="region" disabled>
                                <option value="{{ null }}">Выберите район...</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Школы
                            <select name="school_id" class="form-control" id="school" disabled>
                                <option value="{{ null }}">Выберите школу...</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Классы
                            <select name="grade_id" class="form-control" id="grade" disabled>
                                <option value="{{ null }}">Выберите класс...</option>
                            </select>
                        </label>
                    </div>
                    <div class="form-group col-md-3">
                        <label>
                            Ученик
                            <select name="student_id" class="form-control" id="student" disabled>
                                <option value="{{ null }}">Выберите ученика...</option>
                            </select>
                        </label>
                    </div>
                </div>

                <div class="form-row col-md-12 margin-top-10">
                    <button type="submit" class="btn btn-primary">Поиск</button>
                </div>
            </form>
        </div>

        <div class="col-md-12">
            <div class="result">

                <div class="panel-body">
                    <table class="table table-bordered table-striped {{ isset($students) && count($students) > 0 ? 'datatable' : '' }}">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>@lang('quickadmin.users.fields.name')</th>
                            <th>Результат</th>
                            <th>&nbsp;</th>
                        </tr>
                        </thead>

                        <tbody>
                        @if (isset($students))
                            @foreach($students as $student)
                                @if ($student->tests)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        @if(Auth::user()->isAdmin())
                                            <td>{{ $student->name or '' }} ({{ $student->email or '' }})</td>
                                        @endif
                                        <td>No results!</td>
                                        <td>
                                            No actions!
                                        </td>
                                    </tr>
                                @endif
                                @foreach ($student->tests as $result)
                                    <tr>
                                        <td>{{ $student->id }}</td>
                                        @if(Auth::user()->isAdmin())
                                            <td>{{ $result->user->name or '' }} ({{ $result->user->email or '' }})</td>
                                        @endif
                                        <td>{{ $result->result }}/10</td>
                                        <td>
                                            <a href="{{ route('results.show',[$result->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                        </td>
                                    </tr>
                                @endforeach
                            @endforeach
                        @else
                            <tr>
                                <td colspan="6">@lang('quickadmin.no_entries_in_table')</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

                <form action="{{ route('reports.export') }}">
                    <input type="hidden" name="oblast_id" value="{{ $oblast_id }}">
                    <input type="hidden" name="region_id" value="{{ $region_id }}">
                    <input type="hidden" name="school_id" value="{{ $school_id }}">
                    <input type="hidden" name="grade_id" value="{{ $grade_id }}">
                    <input type="hidden" name="student_id" value="{{ $student_id }}">
                    <button type="submit" class="btn btn-primary">Экспорт</button>
                </form>
            </div>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        $('.input-daterange input').each(function() {
            $(this).datepicker({
                format: "dd/mm/yyyy",
                weekStart: 1
            });
        });
    </script>
    <script>
        let oblast = $('#oblast');
        let region = $('#region');
        let school = $('#school');
        let grade = $('#grade');
        let student = $('#student');

        oblast.change((e) => {
            let id = $(e.currentTarget).val();

            $.ajax({
                url: "{{ route('api.region.oblastId') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: data => {
                    region.prop('disabled', false);
                    school.prop('disabled', true);
                    grade.prop('disabled', true);
                    student.prop('disabled', true);
                    region.empty().append('<option value="">Выберите район...</option>');
                    school.empty().append('<option value="">Выберите школу...</option>');
                    grade.empty().append('<option value="">Выберите класс...</option>');
                    student.empty().append('<option value="">Выберите ученика...</option>');
                    for (item of data) {
                        region.append('<option value="' + item.id + '">' + item.name + '</option>');
                    }
                },
                error: () => {
                    console.log("error");
                }
            })
        });

        region.change(e => {
            let id = $(e.target).val();

            $.ajax({
                url: "{{ route('api.school.regionId') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: data => {
                    school.prop('disabled', false);
                    grade.prop('disabled', true);
                    student.prop('disabled', true);
                    school.empty().append('<option value="">Выберите школу...</option>');
                    grade.empty().append('<option value="">Выберите класс...</option>');
                    student.empty().append('<option value="">Выберите ученика...</option>');
                    for (item of data) {
                        school.append('<option value="' + item.id + '">' + item.name + '</option>')
                    }
                },
                error: () => {
                    console.log("error");
                }
            })
        });

        school.change(e => {

            $.ajax({
                url: "{{ route('api.grade.index') }}",
                method: "GET",
                success: data => {
                    grade.prop('disabled', false);
                    student.prop('disabled', true);
                    grade.empty();
                    grade.append('<option value="">Выберите класс...</option>')
                    student.append('<option value="">Выберите ученика...</option>')
                    for (item of data) {
                        grade.append('<option value="' + item.id + '">' + item.name + '</option>')
                    }
                },
                error: () => {
                    console.log("error");
                }
            })
        })

        grade.change(e => {
            let class_id = $(e.target).val();
            let school_id = school.val();

            $.ajax({
                url: "{{ route('api.students.schoolIdGradeId') }}",
                method: "GET",
                data: {
                    class_id: class_id,
                    school_id: school_id
                },
                success: data => {
                    console.log(data);
                    student.prop('disabled', false);
                    student.empty().append('<option value="">Выберите ученика...</option>');
                    for (item of data) {
                        student.append('<option value="' + item.id + '">' + item.name + '</option>')
                    }
                },
                error: () => {
                    console.log("error");
                }
            })
        })
    </script>
@endsection