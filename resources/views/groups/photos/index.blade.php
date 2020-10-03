@extends("layouts.app")
@section("content")
<h1 class="text-center" >Photos</h1>
<a href="{{action("GroupController@show", ["id" => $groupa->id])}}"
        class="btn btn-lg btn-secondary"> BACK TO GROUP</a>
        
@if(count($photos))



    <div class="row">
        @foreach($photos as $photo)
        <div class="col-md-3">
        <a href="{{action("PhotosController@show", [$photo->group_id , $photo->id])}}">
                    <img class="card-img my-3" style="width: 14rem; height:14rem;" src="/storage/photos/groups/group{{$photo->group_id}}/{{$photo->photo}}" alt="Picture">
            </a>
        </div>
        @endforeach
    </div>
    <br>
    <br>



@else 
<h2 class="text-center">No photos added</h2>

@endif 


@endsection