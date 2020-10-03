@extends('layouts.app')
@section('content')
<a class="btn btn-secondary my-3 p-3" href="{{action("UserController@show", ["id" => Auth::id()])}}">GO BACK</a>
@if(count($messages) > 0)
@foreach($messages as $message)
    <div class="card w-75">
        <div class="card-body">
            <p class="card-title"><strong>Subject:</strong> {{$message->title}}</p>
            <p class="card-text"><strong>From: </strong>{{$message->user->name}}</p>
            <p class="my-1"><strong>Sent at: </strong> {{$message->created_at->format("G:i j. n. Y")}}</p>
            @if($message->read == 0)
            
            <a class="btn btn-danger"href="{{action('MessageController@show', ['id' => $message->id])}}">New Message</a>
            
            @else
            <a class="btn btn-info"href="{{action('MessageController@show', ['id' => $message->id])}}">Detail</a>
            @endif

        </div>
    </div>
@endforeach
@else
<h3 class="display-2 text-center mt-5">Inbox is empty</h3>
@endif

@endsection