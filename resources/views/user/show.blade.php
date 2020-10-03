@extends('layouts.app')

@section('content')

@if($user->photo !== "universal_pic.png")
<a href="{{action("UserController@profile_pic", ["id" => $user->id])}}">
        <img class="card-img my-3" style="width: 12rem; height:12rem;" src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}" alt="Profile picture">
</a>
@else
<a href="{{action("UserController@profile_pic", ["id" => $user->id])}}">
<img class="card-img my-3" style="width: 15rem; height:15rem;" src="/storage/photos/users/default/{{$user->photo}}" alt="Profile picture">
</a>
@endif

    <p><strong>Name: </strong>{{$user->name}}</p>
    <p><strong>Email: </strong>{{$user->email}}</p>
    <p><strong>Address: </strong>{{$user->address}}</p>
    <p><strong>About: </strong>{{$user->about}}</p>
    <p><strong>Phone: </strong>{{$user->phone}}</p>
    <ul class="list-unstyled text-left">
        @foreach($user->tags as $key => $tag)

            <li class="badge badge-success">{{$tag->tag}}</li>

        @endforeach
    </ul>

<div class="d-flex">
    <a class="btn btn-info mr-5" href="{{action('MessageController@create', ['id' => $user->id])}}">Send {{$user->name}} a message!</a>
@if($accepted)
@include("friends.delete")
@else
    @if(!$requested)
    @include("friends.add")
    @else
    @include("friends.cancel")
    @endif
@endif
</div>

@endsection