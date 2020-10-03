@extends("layouts/app")
@section("content")
    <div class="container">
        @if(Session::has('message'))
            <p class="alert alert-info">{{ Session::get('message') }}</p>
        @endif
        <h1 class="text-center display-2 mb-3">{{$groupa->name}}</h1>
        @if($groupa->cover_photo)
            <div class="d-flex justify-content-center">
                <img class="" style="width : 55rem; height : 25rem"
                     src="/storage/photos/groups/group{{$groupa->id}}/coverphotos/{{$groupa->cover_photo}}"
                     alt="Cover Photo">
            </div>
        @endif
        <br>
        <div class="d-flex justify-content-end">

            @if($admin)
                <a class="btn btn-lg btn-primary mr-4 px-5"
                   href="{{action("GroupAdministrationController@createpicture", ["id" => $groupa->id])}}">Upload Cover
                    Picture</a>
            @endif

            <a class="btn btn-lg btn-primary mr-4 px-5"
               href="{{action("PhotosController@index", ["id" => $groupa->id])}}">Photos</a>

            <a class="btn btn-lg btn-secondary" href="{{action("GroupController@index")}}">All Groups</a>


        </div>

        <br><br>
    </div>
    <h3 class=" display-4 text-center mt-3">Group Description:</h3>
    <div class="d-flex justify-content-center mt-1">
        <p class="text-center w-50">{{$groupa->description}}</p>
    </div>
    <h4 class="my-5">
        Number of members: {{$groupa->nr_of_members}}
    </h4>
    <h3>Members:</h3>
    <ul class="list-group">
        @if(count($groupa->users))
            @foreach($groupa->users as $user)
                @foreach($joined_users as $joined_user)
                    @if($user->id == $joined_user->id)
                        <li class="list-group-item">{{$user->name}}
                            @if($admin && $user->id != $auth_user)
                                @include("groups.administration.kick")
                            @endif
                        </li>
                    @endif
                @endforeach
            @endforeach
        @endif
    </ul>
    @if(!$admin)
        @if($private)
            @if($pending_user)
                {!!Form::open(["action" => ["GroupAdministrationController@cancelrequest", $groupa->id], "method" => "POST", "class" => "float-left"])!!}
                {{ Form::submit("Cancel request", ["class" => "btn btn-danger"])}}
                {!!Form::close()!!}
            @else
                @if($joined)
                    {!!Form::open(["action" => ["GroupController@leave", $groupa->id], "method" => "POST", "class" => "float-left", "onsubmit" => 'return confirm("Are you sure you want to leave ' . $groupa->name . ' ?")'])!!}
                    {{ Form::submit("Leave group", ["class" => "btn btn-danger"])}}
                    {!!Form::close()!!}
                @else
                    <a class="btn btn-primary float-left"
                       href="{{action("GroupAdministrationController@joinrequest", ["id" =>$groupa->id])}}">Request to
                        join</a>
                    {{-- {!!Form::open(["action" => ["GroupAdministrationController@joinrequest", $groupa->id], "method" => "POST", "class" => "float-left"])!!}
                    {{ Form::submit("Request to join", ["class" => "btn btn-primary"])}}
                    {!!Form::close()!!} --}}
                @endif
            @endif
        @else
            @if($joined)
                {!!Form::open(["action" => ["GroupController@leave", $groupa->id], "method" => "POST", "class" => "float-left", "onsubmit" => 'return confirm("Are you sure you want to leave ' . $groupa->name . ' ?")'])!!}
                {{ Form::submit("Leave group", ["class" => "btn btn-danger"])}}
                {!!Form::close()!!}
            @else
                {!!Form::open(["action" => ["GroupController@join", $groupa->id], "method" => "GET", "class" => "float-left"])!!}
                {{ Form::submit("Join Group", ["class" => "btn btn-primary"])}}
                {!!Form::close()!!}

            @endif
        @endif
    @endif



    <br>
    <br>
    <br>

    @if(count($groupa->users))
        @if($joined_logged_user)
            @include("groups.articles.create")
            <br>
            <br>
            <a class="btn btn-primary float-right" href="{{action("PhotosController@create", ["id" => $groupa->id])}}">Add
                picture</a>
            <br>
            <hr>
            @include("groups.posts.index")
            <br>
        @endif
    @endif



    @if($admin)
        <a class="btn btn-primary float-right" href="{{action("GroupController@edit", ["id" => $groupa->id])}}">EDIT
            GROUP</a>
    @endif
    <br>
    <br>
    @if($admin)
        @include("groups.administration.delete")
    @endif


    @if($admin && $pending_users)
        @include("groups.administration.pending")
    @endif
    <br>
    <br>
    </div>
@endsection