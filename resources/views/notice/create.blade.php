@extends('layouts.app')

@section('content')

    <form action="{{ action('NoticeController@store') }}" method="post">

        @csrf

        <div class="form-group">

            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('text', 'Text', ['class' => 'control-label']) !!}
            {!! Form::textarea('text', null, ['class' => 'form-control']) !!}

        </div>

            {!! Form::hidden('user_id', $user_id) !!}

        <div class="form-group">
            {!! Form::submit('Save') !!}
        </div>

    </form>


@endsection