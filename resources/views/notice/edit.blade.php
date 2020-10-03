@extends('layouts.app')

@section('content')

    <form action="{{ action('NoticeController@update', ['notice' => $notice->id]) }}" method="post">
        @method('put')
        @csrf

        <div class="form-group">

            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
            {!! Form::text('title', $notice->title, ['class' => 'form-control']) !!}

        </div>

        <div class="form-group">

            {!! Form::label('text', 'Text', ['class' => 'control-label']) !!}
            {!! Form::textarea('text', $notice->text, ['class' => 'form-control']) !!}

        </div>

        {!! Form::hidden('user_id', $notice->user_id) !!}

        <div class="form-group">
            {!! Form::submit('Save') !!}
        </div>

    </form>


@endsection