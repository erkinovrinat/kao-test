@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.levels.title')</h3>
    
    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.view')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr><th>@lang('quickadmin.levels.fields.title')</th>
                    <td>{{ $level->name }}</td></tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('topics.index') }}" class="btn btn-default">@lang('quickadmin.back_to_list')</a>
        </div>
    </div>
@stop