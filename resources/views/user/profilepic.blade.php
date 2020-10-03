@extends("layouts.app")
@section("content")
@if($user->photo !== "universal_pic.png")
<img src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}" alt="Profile picture">
@else
<img src="/storage/photos/users/default/{{$user->photo}}" alt="Profile picture">
@endif
<br>
<br>
<a class="btn btn-secondary" href="{{action("UserController@show", ["id" => $user->id])}}">GO BACK</a>
@endsection