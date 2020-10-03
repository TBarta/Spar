@extends("layouts.app")
@section("content")
<h3 class="display-3 text-center">Almost done!</h3>
<hr>
<br><br><br><br>
<h5 class="display6 text-center">Give your clients an email where they will be able to contact you</h4>
{!!Form::open(["action" => "TrainerController@store", "method" => "POST", 'enctype' => "multipart/form-data"])!!}
{{ csrf_field() }}
{!!Form::email("contact" ,null, ['class' => 'form-control text-center', "placeholder" => "trainer@gmail.com"])!!}
<br><br><br><br>
<h4 class="display5 text-center">Upload a picture!(optional)</h4>
<br>
{!!Form::file("photo", ['class' => 'form-control-file'])!!}
<br><br>
{!!Form::submit("Complete Trainer Registration!" ,["class" => "btn btn-lg btn-block btn-primary"])!!}
{!!Form::close() !!}
<br>
{!!Form::open(["action" => ["TrainerController@goback", "id" => $trainer->id], "method" => "POST"])!!}
    {{ Form::submit("Previous step", ["class" => "btn btn-block btn-secondary mb-5"])}}
{!!Form::close()!!}

@endsection