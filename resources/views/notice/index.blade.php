@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">



            @foreach($notices as $notice)
                <div class="col-md-4 col-lg-3 card w-75 m-3">
                    <div class="card-body">
                        <h5 class="card-title"><strong>{{$notice->title}}</strong></h5>
                        {{--<p class="card-text">{{$message->text}}</p>--}}
                        <a class="btn btn-info"
                           href="{{action('NoticeController@show', ['id' => $notice->id])}}">Show
                            more</a>
                        <p class="my-1"><strong>Posted at: </strong> {{$notice->created_at}}</p>
                        <p class="card-text"><strong>Posted by: </strong>{{$notice->poster}}</p>
                    </div>
                </div>

                {{--<div class="col-md-4">--}}
                    {{--<br><strong>Title: </strong>{{$notice->title}}--}}
                    {{--<br><strong>Text: </strong>{{$notice->text}}--}}
                    {{--<br><strong>OP: </strong>{{$notice->poster}}--}}
                    {{--<br><strong>Sent at: </strong> {{$notice->created_at}}--}}
                    {{--<br><a href="{{action('NoticeController@show', ['id' => $notice->id])}}">Show--}}
                        {{--more</a>--}}
                {{--</div>--}}
            @endforeach

        </div>
    </div>



@endsection