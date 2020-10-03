@extends("layouts.app")

@section("content")

<br>
<a class="btn btn-primary float-right" href="{{action("PhotosController@index", ["id" => $photo->group_id])}}">OTHER PHOTOS</a>
<br>
<h2>{{$photo->user->name}}</h2>
<br>
<h4>{{$photo->description}}</h4>
<hr>
<img src="/storage/photos/groups/group{{$photo->group_id}}/{{$photo->photo}}" alt="Picture">
<br><br>
@if(\Gate::allows('group_admin', $groupa) || \Gate::allows('photo_editor', $photo) ) 
@include("groups.photos.delete")
@endif
<br>
<br>
<a class="btn btn-secondary" href="{{action("GroupController@show", ["id" => $photo->group_id])}}">BACK TO GROUP</a>
<hr>
@endsection