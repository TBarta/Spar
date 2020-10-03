@extends('layouts.app')
    @section('content')
    <div class="container d-flex justify-content-around">
    <div>
            <div class="my-5">
                    @if($new_messages > 0)
                    <a class="btn btn-danger" href="{{action('MessageController@index')}}">INBOX ({{$new_messages}})</a>
                    @else
                    <a class="btn btn-secondary" href="{{action('MessageController@index')}}">INBOX</a>
                    @endif
                    <a class="btn btn-secondary" href="{{action('MessageController@sent')}}">SENT MESSAGES</a>
                    <a class="btn btn-secondary" href="{{action('NoticeController@create')}}">POST A NOTICE</a>
                    <a class="btn btn-secondary" href="{{action('GroupController@create')}}">CREATE A GROUP</a>
            </div>


        @if($user->photo !== "universal_pic.png")
            <a href="{{action("UserController@profile_pic", ["id" => $user->id])}}">
                <img class="card-img my-3" style="width: 15rem; height:15rem;"
                    src="/storage/photos/users/user{{$user->id}}/profilepics/{{$user->photo}}" alt="Profile picture">
            </a>
        @else
            <a href="{{action("UserController@profile_pic", ["id" => $user->id])}}">
                <img class="card-img my-3" style="width: 15rem; height:15rem;"
                    src="/storage/photos/users/default/{{$user->photo}}" alt="Profile picture">
            </a>
        @endif
        <p><strong>Name: </strong>{{$user->name}}</p>
        <p><strong>Email: </strong>{{$user->email}}</p>
        <p><strong>Address: </strong>{{$user->address}}</p>
        <p><strong>About: </strong>{{$user->about}}</p>
        <p><strong>Phone: </strong>{{$user->phone}}</p>
        <ul class="text-left list-unstyled">
        <p><strong>Your tags:</p>
            @foreach($user->tags as $key => $tag)

                <li class="badge badge-success">{{$tag->tag}}</li>

            @endforeach
        </ul>
        <a class="btn btn-secondary my-3 p-3" href="{{action('UserController@edit', ['id' => $user->id])}}">EDIT PROFILE</a>
    </div>
            <div class="d-flex align-items-end flex-column my-5">
                <h3>My groups:</h3>
                    <div class="list-group">
                        @foreach($groups as $group)
                            @if($group)
                                <a href="{{action("GroupController@show", ["id" => $group->id])}}"
                                        class="list-group-item list-group-item-action">{{$group->name}}</a>
                            @endif
                        @endforeach
                    </div>
                    @if(count($user->friends) > 0)
                    <h3>Friends:</h3>
                    <div class="list-group">
                        @foreach($user->friends as $friend)
                            
                                <a href="{{action("UserController@show", ["id" => $friend->id])}}"
                                        class="list-group-item list-group-item-action">{{$friend->name}}</a>
                        @endforeach
                    </div>
                    @endif
            </div>
            @if($requesters)
            <div class="d-flex align-items-end flex-column">
                    <h3>Buddy requests:</h3>
                        <div class="list-group">
                            @foreach($requesters as $requester)
                                <div class="d-flex align-items-center justify-content-end list-group-item">
                                        <h3 class="mr-3"><a href="{{action("UserController@show", ["id" => $requester->id])}}">{{$requester->name}}</a></h3>
                                    @include("friends.accept")
                                    @include("friends.deny")
                                </div>
                                
                            @endforeach
                        </div>
                </div>
            @endif
</div>
@endsection