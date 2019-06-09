@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.levels.title')</h3>

    <p>
        <a href="{{ route('levels.create') }}" class="btn btn-success">@lang('quickadmin.add_new')</a>
    </p>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.list')
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped {{ count($levels) > 0 ? 'datatable' : '' }} dt-select">
                <thead>
                    <tr>
                        <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        <th>@lang('quickadmin.levels.fields.title')</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($levels) > 0)
                        @foreach ($levels as $level)
                            <tr data-entry-id="{{ $level->id }}">
                                <td></td>
                                <td>{{ $level->name }}</td>
                                <td>
                                    <a href="{{ route('levels.show',[$level->id]) }}" class="btn btn-xs btn-primary">@lang('quickadmin.view')</a>
                                    <a href="{{ route('levels.edit',[$level->id]) }}" class="btn btn-xs btn-info">@lang('quickadmin.edit')</a>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("quickadmin.are_you_sure")."');",
                                        'route' => ['levels.destroy', $level->id])) !!}
                                    {!! Form::submit(trans('quickadmin.delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">@lang('quickadmin.no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript')
    <script>
        window.route_mass_crud_entries_destroy = '{{ route('levels.mass_destroy') }}';
    </script>
@endsection