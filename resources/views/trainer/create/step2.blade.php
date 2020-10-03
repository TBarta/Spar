@extends("layouts.app")
@section("content")
<h3 class="display-3 text-center">Something about you</h3>
<hr>
<br><br><br><br>
<h4 class="display5 text-center">Do you have any extra qualification? <span class="small">(optional)</span></h4>
{!!Form::open(["action" => "TrainerController@store", "method" => "POST"])!!}
{{ csrf_field() }}
{!!Form::text("qualification" ,null, ['class' => 'form-control text-center', "placeholder" => "i. e. Personal trainer certificate"])!!}
<br><br><br><br>
<h4 class="display5 text-center">Tell your clients about your experience in the field</h4>
<br>
{!!Form::textArea("experience" ,null, ['class' => 'form-control text-center',"rows" => 3, "placeholder" => "i. e. Participated in several bodybuilding competitions"])!!}
<br><br>
{!!Form::submit("Next" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}
<br>
{!!Form::open(["action" => ["TrainerController@goback", "id" => $trainer->id], "method" => "POST"])!!}
    {{ Form::submit("Previous step", ["class" => "btn btn-block btn-secondary mb-5"])}}
{!!Form::close()!!}




@endsection