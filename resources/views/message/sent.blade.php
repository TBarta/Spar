@extends('layouts.app')
@section('content')
<a class="btn btn-secondary my-3 p-3" href="{{action("UserController@show", ["id" => Auth::id()])}}">GO BACK</a>

@foreach($messages as $message)
    <div class="card w-75">
        <div class="card-body">
            <p class="card-title"><strong>Subject:</strong> {{$message->title}}</p>
            <p class="card-text"><strong>To: </strong>{{$message->recipient->name}}</p>
            <p class="my-1"><strong>Sent at: </strong> {{$message->created_at->format("G:i j. n. Y")}}</p>

            <a class="btn btn-info"href="{{action('MessageController@show', ['id' => $message->id])}}">Show
            more</a>

        </div>
    </div>
@endforeach



@endsection