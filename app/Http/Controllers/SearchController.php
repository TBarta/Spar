<?php

namespace App\Http\Controllers;

use App\Group;
use App\User;
use App\Tag;
use App\Trainer;
use App\Notice;
use Illuminate\Http\Request;
use Auth;

class SearchController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($users)
    {
//        return view('search.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('search.create', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_simple(Request $request)
    {
        $query = $request->input('search');
        return redirect()->action("SearchController@show_simple", ['query' => $query]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_simple(Request $request)
    {
        $query = $request->get('query', '');

        $users = User::search($query)->orderBy('name', 'asc')->get();
        $groups = Group::search($query)->get();
        $trainers = Trainer::search($query)->get();
        $notices = Notice::search($query)->get();
        return view('search.showsimple', ['users' => $users, 'groups' => $groups, 'trainers' => $trainers, 'notices' => $notices]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function store(Request $request)
    {
        $users = User::paginate(10);
        $tags = $request->input('tag');
        foreach($users as $user){
            $count = 0;
            foreach($user->tags as $tag){
                if(in_array($tag->id, $tags)) $count++;
            }
            $user->count = $count;
        }
        $users = $users->sortByDesc('count');

        return view('search.index', ['users' => $users]);
        return redirect()->action("SearchController@index", ["users" => $users]);

    }

    public function show(Request $request)
    {

    }
}
