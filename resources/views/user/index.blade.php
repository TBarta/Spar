@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @foreach($users as $user)


                    <div class="col-md-3 col-lg-3 my-3">
                        <div class="card mx-auto mb-5 text-center w-100 h-100">
                            <div class="card-body">
                                <a href="{{action("UserController@show", [$user->id])}}">
                                    @if($user->photo !== "universal_pic.png")
                                        <img class="card-img my-3" src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}" alt="Picture" style="height:12rem">
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



            @endforeach
        </div>
    </div>


@endsection