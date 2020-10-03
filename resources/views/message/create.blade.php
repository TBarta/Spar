@extends('layouts.app')

@section('content')

    <form action="{{ action('MessageController@store', ['id' => $recipient_id]) }}" method="post">

        @csrf

        <div class="form-group">

            {!! Form::label('title', 'Subject', ['class' => 'control-label']) !!}
            {!! Form::text('title', null, ['class' => 'form-control',"required"]) !!}

        </div>

        <div class="form-group">

            {!! Form::label('text', 'Text', ['class' => 'control-label']) !!}
            {!! Form::textarea('text', null, ['class' => 'form-control', "rows" => 4, "required"]) !!}

        </div>
        {{Form::hidden("recipient_id", $recipient_id)}}

        <div class="form-group">
            {!! Form::submit('Send', ["class"=>"btn btn-block btn-primary"]) !!}
        </div>

    </form>

@endsection