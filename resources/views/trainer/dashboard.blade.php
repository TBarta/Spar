@extends("layouts.app")
@section("content")
<br>
<a class="btn btn-primary float-right" href="{{action("TrainerController@edit", ["id" => $trainer->id])}}">EDIT YOUR PROFILE</a>
<br><br>
<h1 class="text-center display-2">{{$trainer->user->name}}</h1>

@if($trainer->photo !== "trainer.png")
<div class="card mx-auto text-center" style="width: 30rem;">
    <img class="card-img-top" src="/storage/photos/trainers/trainer{{$trainer->id}}/profilepics/{{$trainer->photo}}" alt="Trainer Profile Picture">
</div>
@else
<div class="card mx-auto text-center" style="width: 30rem;">
                <img class="card-img-top" src="/storage/photos/users/default/trainer.png" alt="Trainer Profile Picture">
</div>
@endif
<br><br>


<div class="d-flex justify-content-end">
<h4 class="display-5">Contact : {{$trainer->contact}}</h4>
</div>
<hr>
<br><br>
<div class="d-flex">
<h5 class="display-4 mr-5">What I train:</h3>
<h4 class="display-3 ml-2"> {{$trainer->field}}</h4>
</div>

<br><br>


<div class="d-flex p-5 justify-content-center">
        <div class="card" style="width: 30rem;">
                <div class="card-body">
                <h5 class="card-title text-center">Training Program</h5>
                <hr>
                <p class="card-texttext-center">{{$trainer->program}}.</p>
                <p class="card-text text-center">€{{$trainer->price}}</p>
                </div>
        </div>
    </div>
    <br><br>

<div class="d-flex justify-content-around p-2">

    <div class="card" style="width: 30rem;">
        <div class="card-body">
        <h5 class="card-title text-center">Qualification and achievements</h5>
        <hr>
        <p class="card-text text-center">{{$trainer->qualification}}</p>
        </div>
    </div>
    <div class="card" style="width: 30rem;">
        <div class="card-body">
        <h5 class="card-title text-center">About trainer</h5>
        <hr>
        <p class="card-text text-center">{{$trainer->experience}}.</p>
        </div>
    </div>

</div>
<br>

{!!Form::open(["action" => ["TrainerController@destroy", "id" =>  $trainer->id], "method" => "POST", "class" => "float-right", "onsubmit" => 'return confirm("Are you sure you want to delete your trainer profile ?")'])!!}
@method("delete")
    {{ Form::submit("Delete profile", ["class" => "btn btn-lg btn-danger m-5"])}}
{!!Form::close()!!}

@endsection
