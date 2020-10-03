@extends('layouts.app')

@section('content')
<div class="my-5 d-flex">
<a class="btn btn-secondary mr-3" href="{{action('MessageController@index')}}">INBOX</a>
<a class="btn btn-secondary" href="{{action('MessageController@sent')}}">SENT MESSAGES</a>
</div>
@if(count($previous_messages) > 0)
    @foreach($previous_messages as $previous_message)
    @if(Auth::id() == $previous_message->user->id)
    <div class="d-flex justify-content-end">
    @else
    <div class="d-flex justify-content-start">
    @endif
        <div class="card body w-50 text-center m-3">
            <div class="d-flex mx-auto my-4">
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
    <br>
@endif

            <div class="card w-75 d-flex mx-auto mb-5">
                <div class="card-body mx-auto">
                    <h5 class="card-title"><strong>Subject: </strong>{{$message->title}}</h5>
                    <h5 class="card-subtitle"><strong>To: </strong><a href="{{action("UserController@show", ["id" => $message->recipient->id])}}">{{$message->recipient->name}}</a></h5>
                    <h5 class="mt-3"><strong>Message: </strong></h5>
                    <p class="card-text my-3 p-3">{{$message->text}}</p>
                    <p class="my-1 card-text"><strong>Sent at: </strong> {{$message->created_at->format("j. n. G:i")}}</p>
                    <p class="card-text"><strong>Sent by: </strong>{{$message->user->name}}</p>
                </div>
                @if(Auth::id() == $message->recipient->id)
                    <a class="btn btn-lg btn-primary" href="{{action("MessageController@respond", ["id" => $message->id])}}">Respond</a>
                @endif
            </div>

@endsection