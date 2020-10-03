@if($posts)
@foreach($posts as $post)
                
@if($post->photo_id);
    <div class="card mx-auto text-center" style="width: 25rem;">
            <h2 class="card-title">{{$post->photo->user->name}}</h2>
            <p class="card-text">{{$post->photo->description}}</p>
            <a href="{{action("PhotosController@show", [$groupa->id , $post->photo_id])}}">
                    <img class="card-img-top" src="/storage/photos/groups/group{{$post->photo->group_id}}/{{$post->photo->photo}}" alt="Picture">
            </a>
            </div>
    </div>
    <br>

@else
<div class="card mx-auto text-center" style="width: 25rem;">
        <div class="card-headline text-center">
            
        <h3>{{$post->article->user->name}} </h3>  
               @if(\Gate::allows('article_editor', $post->article)) 
                    <a class="btn btn-sm btn-primary float-right" href="{{action("GroupArticlesController@edit", ["id" => $post->article->id , "group" => $groupa->id])}}">EDIT</a>
                @endif
                @if(\Gate::allows('group_admin', $groupa) || \Gate::allows('article_editor', $post->article) ) 
                    @include("groups.articles.delete")
                @endif
                
        
        </div>
        <div class="card-body">
        <p class="text-center">{{$post->article->article}}</p>
        </div>
    </div>
    <br><br>

@endif
@endforeach
@endif 