@extends("layouts.app")
@section("content")
<div class="d-flex justify-content-end">
<a class="btn btn-lg btn-success mt-5" href="{{action("GroupController@create")}}">CREATE NEW GROUP</a>
</div>
<br><br>

@foreach($groups as $group)

@if($group->cover_photo)
<div class="card mx-auto text-center" style="width: 30rem;">
    <h3><a href="{{action("GroupController@show" , ["id" => $group->id])}}">{{$group->name}}</a></h3>
    <p class="card-text">Members: {{$group->nr_of_members}}</p>
    @if($group->private)
    <p class="card-text">Private group</p>
    @else
    <p class="card-text">Public group</p>
    @endif
    <a href="{{action("GroupController@show", [$group->id])}}">
            <img class="card-img-top" src="/storage/photos/groups/group{{$group->id}}/coverphotos/{{$group->cover_photo}}" alt="Cover photo">
    </a>
</div>
<br><hr><br>
@else
<div class="card mx-auto text-center" style="width: 30rem;">
    <h3><a href="{{action("GroupController@show" , ["id" => $group->id])}}">{{$group->name}}</a></h3>
    <p class="card-text">Members: {{$group->nr_of_members}}</p>
    @if($group->private)
    <p class="card-text">Private group</p>
    @else
    <p class="card-text">Public group</p>
    @endif
</div>
<br><hr><br>
@endif


@endforeach


{{$groups->render()}}


@endsection