@extends("layouts.app")
@section("content")
<a href="{{action("TrainerController@dashboard")}}"
        class="btn btn-lg btn-secondary my-5">GO BACK</a>

<h1 class="text-center display-2">{{$trainer->user->name}}</h1>
{!!Form::open(["action" => ["TrainerController@update", "id" => $trainer->id], "method" => "POST", "enctype" => "multipart/form-data"])!!}
@method("put")
<div class="card mx-auto text-center" style="width: 30rem;">
                <img class="card-img-top" src="/storage/photos/users/default/trainer.png" alt="Trainer Profile Picture">
                <br>
                <h5 class="card-subtitle text-center">Change your picture</h5>
                <br>
                {!!Form::file("photo" , ['class' => 'form-control-file'])!!}
</div>

<br><br>


<div class="d-flex flex-column justify-content-end">
{!! Form::label('contact', 'Contact', ['class' => 'control-label']) !!}
{!! Form::email('contact', $trainer->contact, ['class' => 'form-control text-center', "required"]) !!}
</div>
<hr>
<br><br>
<div class="d-flex flex-column">
    {!! Form::label('field', 'What I Train', ['class' => 'control-label']) !!}
    {!!Form::text("field" , $trainer->field, ['class' => 'form-control text-center', "placeholder" => "Weightlifting, Basketball, Gymnastics, etc..", "required"])!!}
</div>

<br><br>


<div class="d-flex p-5 justify-content-center">
        <div class="card" style="width: 30rem;">
                <div class="card-body">
                    {!! Form::label('program', 'Training program', ['class' => 'control-label']) !!}
                    {!!Form::textArea("program" ,$trainer->program, ['class' => 'form-control text-center',"rows" => 5, "placeholder" => "Why should we buy your program?", "required"])!!}
                    {!! Form::label('price', 'Select price', ['class' => 'control-label']) !!}
                    {!!Form::number("price" , $trainer->price, ['class' => 'form-control text-center',"step" => "0.01","min" => "1","max" =>"5000", "required"])!!}
                </div>
        </div>
    </div>
    <br><br>

<div class="d-flex justify-content-around p-2">

    <div class="card" style="width: 30rem;">
        <div class="card-body">
            {!! Form::label('qualification', 'Qualification and achievements', ['class' => 'control-label']) !!}
            {!!Form::text("qualification" ,$trainer->qualification, ['class' => 'form-control text-center', "placeholder" => "i. e. Personal trainer certificate", "required"])!!}
        </div>
    </div>
    <div class="card" style="width: 30rem;">
        <div class="card-body">
            {!! Form::label('experience', 'About trainer', ['class' => 'control-label']) !!}
            {!!Form::textArea("experience" ,$trainer->experience, ['class' => 'form-control text-center',"rows" => 3, "placeholder" => "i. e. Participated in several bodybuilding competitions", "required"])!!}
        </div>
    </div>

</div>
<br>
{!!Form::submit("Save changes" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}
<br>

@endsection
