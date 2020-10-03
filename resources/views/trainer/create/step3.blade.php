@extends("layouts.app")
@section("content")
<h3 class="display-3 text-center">Training Program</h3>
<hr>
<br><br><br><br>
<h4 class="display5 text-center">Describe your training program to your clients</h4>
{!!Form::open(["action" => "TrainerController@store", "method" => "POST"])!!}
{{ csrf_field() }}
{!!Form::textArea("program" ,null, ['class' => 'form-control text-center',"rows" => 5, "placeholder" => "Why should we buy your program?", "required"])!!}
<br><br><br><br>
<h4 class="display5 text-center">Enter the cost of your program</h4>
<br>
<div class="input-group mb-3">
    {!!Form::number("price" ,null, ['class' => 'form-control text-center',"step" => "0.01","min" => "1","max" =>"5000", "placeholder" => "19.99", "required"])!!}
    <div class="input-group-append">
        <span class="input-group-text"> EUR</span>
    </div>
 </div>

<br><br>
{!!Form::submit("Next" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}
<br>
{!!Form::open(["action" => ["TrainerController@goback", "id" => $trainer->id], "method" => "POST"])!!}
    {{ Form::submit("Previous step", ["class" => "btn btn-block btn-secondary mb-5"])}}
{!!Form::close()!!}

@endsection