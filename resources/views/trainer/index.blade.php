@extends("layouts.app")
@section("content")
@foreach($trainers as $trainer)

@if($trainer->photo !== "trainer.png")
<div class="card mx-auto text-center" style="width: 20rem;">
    <h3><a href="{{action("TrainerController@show" , ["id" => $trainer->id])}}">{{$trainer->user->name}}</a></h3>
    <p class="card-text">{{$trainer->program}}</p>
    <a href="{{action("TrainerController@show", [$trainer->id])}}">
            <img class="card-img-top" src="/storage/photos/trainers/trainer{{$trainer->id}}/profilepics/{{$trainer->photo}}" alt="Trainer Profile Picture">
    </a>
</div>
<br><hr><br>
@else
<div class="card mx-auto text-center" style="width: 20rem;">
    <h3><a href="{{action("TrainerController@show" , ["id" => $trainer->id])}}">{{$trainer->user->name}}</a></h3>
    <p class="card-text">{{$trainer->program}}</p>
    <a href="{{action("TrainerController@show", [$trainer->id])}}">
            <img class="card-img-top" src="/storage/photos/users/default/trainer.png" alt="Trainer Profile Picture">
    </a>
</div>
<br><hr><br>
@endif


@endforeach
@endsection