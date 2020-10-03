@extends('layouts.app')

@section('content')

        <div class="card-body">
            <h5 class="card-title"><strong>{{$notice->title}}</strong></h5>
            <p class="card-text">{{$notice->text}}</p>
            <p class="my-1"><strong>Posted at: </strong> {{$notice->created_at}}</p>
            <p class="card-text"><strong>Posted by: </strong>{{$notice->poster}}</p>
            @if($auth_id == $notice->user_id)
                <a class="btn btn-primary" href="{{action('NoticeController@edit', ['id' => $notice->id])}}">EDIT</a>
                @include("notice.delete")
            @endif
            @if($auth_id != $notice->user_id)
                <a class="btn btn-info" href="{{action('MessageController@create', ['id' => $notice->user_id])}}">Send a message</a>
            @endif
        </div>


@endsection