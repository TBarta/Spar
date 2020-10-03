<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\GroupArticles;
use App\Group;
use App\User;
use App\Post;


class GroupArticlesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware("article")->except("store", "destroy");

    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Group $group)
    {
        $group = Group::find($group->id);
        $user = Auth::id();

        $article = GroupArticles::create([
            "group_id" => $group->id,
            "user_id" => $user,
            "article" => $request->input("text"),
        ]);
        Post::create([
            "article_id" => $article->id,
            "group_id" => $group->id,
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, $id)
    {
        $article = GroupArticles::FindOrFail($id);
        $view = view("groups.articles.edit");
        $view->group = $group;
        $view->article = $article;
        return $view;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Group $group, $id)
    {
        $article = GroupArticles::find($id);

        $article->update([
            "article" => $request->input("text"),
        ]);


        return redirect("/groups/{$group->id}")->with("success", "Post edited");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group, $id)
    {
        $article = GroupArticles::find($id);
        $post = Post::where("article_id", $id)->first();
        $post->delete();
        $article->delete();
        return redirect("/groups/{$group->id}")->with("success", "Post deleted");
    }
}
