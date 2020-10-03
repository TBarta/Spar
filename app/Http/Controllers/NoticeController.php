<?php

namespace App\Http\Controllers;

use App\Notice;
use Illuminate\Http\Request;
use App\User;
use Auth;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notices = Notice::latest()->get();
        foreach($notices as $notice){
            $notice['poster'] = User::select('name')->where('id', '=', $notice->user_id)->get()[0]['name'];
        }
        return view('notice.index', ['notices' => $notices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        return view('notice.create', ['user_id' => $user_id]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            "title" => "required",
            "text" => "required",
        ]);

        $notice = Notice::create([
            "title" => $request->input("title"),
            "text" => $request->input("text"),
            'user_id' => $request->input('user_id')
        ]);

        session()->flash('success_message', 'Success!');

        return redirect()->action("NoticeController@show", ['id' => $notice->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notice = Notice::where('id', '=', $id)->first();
        $notice['poster'] = User::select('name')->where('id', '=', $notice->user_id)->get()[0]['name'];
        $auth_id = Auth::id();


        return view('notice.show', ['notice' => $notice, 'auth_id' => $auth_id]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice)
    {
        if($notice->user_id == Auth::id()){
            return view('notice.edit', ['notice' => $notice]);
        }
        return 'You do not have permission to view this page.';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice)
    {
        $notice = Notice::findOrFail($notice->id);

        $notice->update([
            "title" => $request->input("title"),
            "text" => $request->input("text"),
            'user_id' => $request->input('user_id')
        ]);

        session()->flash('success_message', 'Success!');

        return redirect()->action("NoticeController@show", ["id" => $notice->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notice  $notice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice)
    {
        
        $notice = Notice::find($notice->id);
        $notice->delete();

        return redirect(action("NoticeController@index"))->with("success", "Notice deleted");

    }
}
