@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($users as $user)

                @if($user->id != Auth::id() && $user->count > 0)
                    <div class="col-md-4 col-lg-3">
                        <div class="card mx-auto mb-5 text-center w-100 h-100">
                            <div class="card-body">
                                <a href="{{action("UserController@show", [$user->id])}}">
                                    @if($user->photo !== "universal_pic.png")
                                        <img class="card-img my-3" src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}" alt="Picture">
                                    @else
                                        <img class="card-img my-3" src="/storage/photos/users/default/{{$user->photo}}" alt="Picture">
                                    @endif
                                </a>
                                <a href="{{action("UserController@show", [$user->id])}}">
                                    <h5 class="card-title">{{$user->name}}</h5>
                                </a>
                                <p class="card-text">{{$user->email}}.</p>
                                <ul class="list-unstyled text-left">
                                    @foreach($user->tags as $key => $tag)

                                        <li class="badge badge-success">{{$tag->tag}}</li>

                                    @endforeach
                                </ul>

                            </div>
                        </div>
                    </div>
                    {{--<div class="col-md-4">--}}
                        {{--<div class="card mx-auto mb-5 text-center" style="width: 12rem;">--}}
                            {{--<a href="{{action("UserController@show", [$user->id])}}">--}}
                                {{--@if($user->photo !== "universal_pic.png")--}}
                                    {{--<img class="card-img my-3"--}}
                                         {{--src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}"--}}
                                         {{--alt="Picture" style="width: 11.9rem; height:10rem;">--}}
                                {{--@else--}}
                                    {{--<img class="card-img my-3" src="/storage/photos/users/default/{{$user->photo}}"--}}
                                         {{--alt="Picture" style="width: 11.9rem; height:10rem;">--}}
                                {{--@endif--}}
                            {{--</a>--}}
                            {{--<a href="{{action("UserController@show", [$user->id])}}">--}}
                                {{--<h5 class="card-title">{{$user->name}}</h5>--}}
                            {{--</a>--}}
                            {{--<p class="card-text">{{$user->email}}.</p>--}}
                            {{--<p class="card-text">--}}
                                {{--@foreach($user->tags as $key => $tag)--}}

                                    {{--<br><strong>{{$key+1}}: </strong> {{$tag->tag}}--}}

                                {{--@endforeach</p>--}}
                        {{--</div>--}}
                    {{--</div>--}}

                @endif

            @endforeach
        </div>
    </div>


@endsection