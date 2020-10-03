@extends('layouts.app')

@section('content')

    @foreach($previous_messages as $previous_message)
    @if(Auth::id() == $previous_message->user->id)
    <div class="d-flex justify-content-end">
    @else
    <div class="d-flex justify-content-start">
    @endif
        <div class="card body w-50 text-center mt-3">
            <div class="d-flex mx-auto mt-4">
                <h2 class="card-title mr-3"><a href="{{action("UserController@show", ["id" => $previous_message->user->id])}}">{{$previous_message->user->name}}</a></h2>
                @if($previous_message->user->photo !== "universal_pic.png")
                <a href="{{action("UserController@show", ["id" => $previous_message->user->id])}}">
                    <img class="card-img" style="width: 4em; height:3em; border-radius:50%;"
                        src="/storage/photos/users/user{{$previous_message->user->id}}/profilepics/{{$previous_message->user->photo}}"
                        alt="Profile picture">
                </a>
                @else
                <a href="{{action("UserController@show", ["id" => $previous_message->user->id])}}">
                <img class="card-img" style="width: 3.5rem; height:3rem;"
                    src="/storage/photos/users/default/{{$previous_message->user->photo}}" alt="Profile picture">
                </a>
                @endif
            </div>
            <p class="card-text my-2">{{$previous_message->created_at->format("j. n. G:i")}}</p>
            <h4 class="card-text my-3 p-3">{{$previous_message->text}}</h4>
        </div>
    </div>
    @endforeach
    <br><hr><br>
    <form class="d-flex-columnt mx-auto w-50" action="{{ action('MessageController@respond_store', ["id" => $message->id])}}" method="post">

        @csrf

        <div class="form-group">

        <h5 class="card-title"><strong>Subject: </strong>{{$message->title}}</h5>

        </div>

        <div class="form-group">

            {!! Form::label('text', 'Text', ['class' => 'control-label']) !!}
            {!! Form::textarea('text', null, ['class' => 'form-control', "rows" => 4, "required"]) !!}

        </div>
        {{Form::hidden("recipient_id", $message->user->id)}}
        {{Form::hidden("title", $message->title)}}
        {{Form::hidden("category", $message->category)}}
        

        <div class="form-group">
            {!! Form::submit('Send', ["class"=>"btn btn-block btn-primary"]) !!}
        </div>

    </form>

@endsection