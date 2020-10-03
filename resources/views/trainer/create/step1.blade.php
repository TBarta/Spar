@extends("layouts.app")
@section("content")
<h3 class="display-3 text-center">What are you going to train?</h3>
<hr>
<br><br><br><br>
{!!Form::open(["action" => "TrainerController@store", "method" => "POST"])!!}
{{ csrf_field() }}
{!!Form::text("field" ,null, ['class' => 'form-control text-center', "placeholder" => "Weightlifting, Basketball, Gymnastics, etc.."])!!}
<br><br>
{!!Form::submit("Next" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}

@endsection