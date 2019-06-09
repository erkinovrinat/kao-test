@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('oblast_id') ? 'has_error' : '' }}">
                            <label class="col-md-4 control-label" for="oblast_id">Выберите область</label>

                            <div class="col-md-6">
                                <select class="form-control" name="oblast_id" id="oblast_id">
                                    <option value="{{ null }}">Выберите ...</option>
                                    @foreach($oblasts as $oblast)
                                        <option value="{{ $oblast->id }}">{{ $oblast->name }}</option>
                                    @endforeach
                                </select>

                                @if ($errors->has('oblast_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('oblast_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('region_id') ? 'has_error' : '' }}">
                            <label class="col-md-4 control-label" for="region_id">Выберите регион</label>

                            <div class="col-md-6">
                                <select class="form-control" name="region_id" id="region_id" disabled>
                                    <option value="{{ null }}">Выберите ...</option>
                                </select>

                                @if ($errors->has('region_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('region_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('school_id') ? 'has_error' : '' }}">
                            <label class="col-md-4 control-label" for="school_id">Выберите школу</label>

                            <div class="col-md-6">
                                <select class="form-control" name="school_id" id="school_id" disabled>
                                    <option value="{{ null }}">Выберите ...</option>

                                </select>

                                @if ($errors->has('school_id'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('school_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group {{ $errors->has('class') ? 'has_error' : '' }}">
                            <label class="col-md-4 control-label" for="class_id">Ваш класс</label>

                            <div class="col-md-6">
                                <select class="form-control"  name="class" id="class_id" disabled>
                                    <option value="{{ null }}">Выберите ...</option>
                                </select>

                                @if ($errors->has('class'))
                                    <span class="help-block">
                                    <strong>{{ $errors->first('class') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('javascript')
    <script>
        let region = $('#region_id');
        let school = $('#school_id');
        let classSelect = $('#class_id');

        $('#oblast_id').change((e) => {
            let id = $(e.target).val();

            $.ajax({
                url: "{{ route('api.region.oblastId') }}",
                method: "GET",
                data: {
                    id: id
                },
                success: data => {
                    region.prop('disabled', false);
                    school.prop('disabled', true);
                    classSelect.prop('disabled', true);
                    region.empty();
                    school.empty();
                    classSelect.empty();
                    region.append('<option value="' + null + '">Выберите ...</option>');
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
                    classSelect.prop('disabled', true);
                    school.empty();
                    classSelect.empty();
                    school.append('<option value="' + null + '">Выберите ...</option>')
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
                    classSelect.prop('disabled', false);
                    classSelect.empty();
                    classSelect.append('<option value="' + null + '">Выберите ...</option>')
                    for (item of data) {
                        classSelect.append('<option value="' + item.id + '">' + item.name + '</option>')
                    }
                },
                error: () => {
                    console.log("error");
                }
            })
        })
    </script>
@stop
