@extends('layouts.app')

@section('content')
    @if(sizeof($users)>0)
    <div class="container">
        <h2 class="display-4 my-3">Users:</h2>
        <div class="row">
            @foreach($users as $user)

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

            @endforeach

        </div>
    </div>
    @else
        <h2 class="display-4 my-3">No users found!</h2>
    @endif

    @if(sizeof($groups)>0)
    <div class="container">
        <h2 class="display-4 my-3">Groups:</h2>
        <div class="row">
            @foreach($groups as $group)
                    <div class="col-md-4">
                        {{-- <div class="card mx-auto mb-5 text-center w-100 h-100"> --}}
                                @if($group->cover_photo)
                                <div class="card mx-auto text-center my-4" style="width: 30rem;">
                                    <h3><a href="{{action("GroupController@show" , ["id" => $group->id])}}">{{$group->name}}</a></h3>
                                    <p class="card-text">Members: {{$group->nr_of_members}}</p>
                                    @if($group->private)
                                    <p class="card-text">Private group</p>
                                    @else
                                    <p class="card-text">Public group</p>
                                    @endif
                                    <a href="{{action("GroupController@show", [$group->id])}}">
                                            <img class="card-img-top" src="/storage/photos/groups/group{{$group->id}}/coverphotos/{{$group->cover_photo}}" alt="Cover photo">
                                    </a>
                                </div>
                                @else
                                <div class="card mx-auto text-center" style="width: 30rem;">
                                    <h3><a href="{{action("GroupController@show" , ["id" => $group->id])}}">{{$group->name}}</a></h3>
                                    <p class="card-text">Members: {{$group->nr_of_members}}</p>
                                    @if($group->private)
                                    <p class="card-text">Private group</p>
                                    @else
                                    <p class="card-text">Public group</p>
                                    @endif
                                </div>
                                @endif
                        {{-- <br><strong>Name: </strong>{{$group->name}}
                        <br><strong>Email: </strong>{{$group->description}} --}}
                        {{--<br><strong>Address: </strong>{{$user->address}}--}}
                        {{--<br><strong>About: </strong>{{$user->about}}--}}
                        {{--<br><strong>Phone: </strong>{{$user->phone}}--}}
                        {{--<br><strong>Photo: </strong>{{$user->photo}}--}}
                        {{--@foreach($user->tags as $key => $tag)--}}

                            {{--<br><strong>{{$key+1}}: </strong> {{$tag->tag}}--}}

                        {{--@endforeach--}}
                        {{-- <br><a href="{{action('GroupController@show', ['id' => $group->id])}}">See more
                            about {{$group->name}}!</a> --}}

                    </div>

            @endforeach

        </div>
    </div>
    @else
        <h2 class="display-4 my-3">No groups found!</h2>
    @endif

    @if(sizeof($trainers)>0)
    <div class="container">
        <h2 class="display-4 my-3">Trainers:</h2>
        <div class="row">
            @foreach($trainers as $trainer)
                <div class="col-md-4 col-lg-3">
                    <div class="card mx-auto mb-5 text-center w-100 h-100">
                        <div class="card-body">
                            <a href="{{action("TrainerController@show", [$trainer->id])}}">
                                @if($trainer->photo !== "universal_pic.png")
                                    <img class="card-img-top" src="/storage/photos/trainers/trainer{{$trainer->id}}/profilepics/{{$trainer->photo}}" alt="Trainer Profile Picture">
                                @else
                                    <img class="card-img my-3" src="/storage/photos/users/default/{{$trainer->photo}}" alt="Picture">
                                @endif
                            </a>
                            <a href="{{action("TrainerController@show", [$trainer->id])}}">
                                <h5 class="card-title">{{$trainer->trainer_name}}</h5>
                            </a>
                            <p class="card-text">{{$trainer->field}}.</p>

                        </div>
                    </div>
                </div>

                {{--<div class="col-md-4">--}}
                    {{--<br><strong>Name: </strong>{{$trainer->trainer_name}}--}}
                    {{--<br><strong>Field: </strong>{{$trainer->field}}--}}
                    {{--<br><strong>Rate: </strong>{{$trainer->price}}--}}
                    {{--<br><strong>About: </strong>{{$user->about}}--}}
                    {{--<br><strong>Phone: </strong>{{$user->phone}}--}}
                    {{--<br><strong>Photo: </strong>{{$user->photo}}--}}
                    {{--@foreach($user->tags as $key => $tag)--}}

                        {{--<br><strong>{{$key+1}}: </strong> {{$tag->tag}}--}}

                    {{--@endforeach--}}
                    {{--<br><a href="{{action('TrainerController@show', ['id' => $trainer->id])}}">See more--}}
                        {{--about {{$trainer->trainer_name}}!</a>--}}

                {{--</div>--}}

            @endforeach

        </div>
    </div>
    @else
        <h2 class="display-4 my-3">No trainers found!</h2>
    @endif

    @if(sizeof($notices)>0)
        <div class="container">
            <h2 class="display-4 my-3">Notices:</h2>
            <div class="row">
                @foreach($notices as $notice)
                    <div class="col-md-4 mb-4">
                        <div class="card mx-auto mb-2 text-center w-100 h-100">
                            <div class="card-body">
                                {{--<a href="{{action("TrainerController@show", [$trainer->id])}}">--}}
                                {{--@if($trainer->photo !== "universal_pic.png")--}}
                                {{--<img class="card-img-top" src="/storage/photos/trainers/trainer{{$trainer->id}}/profilepics/{{$trainer->photo}}" alt="Trainer Profile Picture">--}}
                                {{--@else--}}
                                {{--<img class="card-img my-3" src="/storage/photos/users/default/{{$trainer->photo}}" alt="Picture">--}}
                                {{--@endif--}}
                                {{--</a>--}}
                                <h5 class="card-text"><a class="mb-3" href="{{action("NoticeController@show", [$notice->id])}}">{{$notice->title}}</a></h5>
                                <h3 class="card-title mt-3">
                                    <a href="{{action("UserController@show", [$notice->user->id])}}">{{$notice->user->name}}</a>
                                </h3>

                            </div>
                        </div>
                        {{--<br><strong>Name: </strong>{{$group->name}}--}}
                        {{--<br><strong>Email: </strong>{{$group->description}}--}}
                        {{--<br><strong>Address: </strong>{{$user->address}}--}}
                        {{--<br><strong>About: </strong>{{$user->about}}--}}
                        {{--<br><strong>Phone: </strong>{{$user->phone}}--}}
                        {{--<br><strong>Photo: </strong>{{$user->photo}}--}}
                        {{--@foreach($user->tags as $key => $tag)--}}

                        {{--<br><strong>{{$key+1}}: </strong> {{$tag->tag}}--}}

                        {{--@endforeach--}}
                        {{--<br><a href="{{action('GroupController@show', ['id' => $group->id])}}">See more--}}
                            {{--about {{$group->name}}!</a>--}}

                    </div>

                @endforeach

            </div>
        </div>
    @else
        <h2class="display-4 my-3">No notices found!</h2>
    @endif



@endsection