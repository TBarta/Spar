<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
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
    public function index()
    {
        $view = view("message.index");
        $messages = Message::where("recipient_id",Auth::id())->latest()->get();
        $view->messages = $messages;
        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        return view('message.create', ['recipient_id' => $id]);
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


        $message = Message::create([
            "title" => $request->input("title"),
            "text" => $request->input("text"),
            'sender_id' => Auth::id(),
            'recipient_id' => $request->input("recipient_id"),
            'read' => 0,
        ]);

        $message->update([
            "category" => $message->id,
        ]);


        session()->flash('success_message', 'Message Sent!');

        return redirect()->action("MessageController@sent", ['id' => Auth::id()])->with("success", "Message sent!");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::find($id);
        $previous_messages = Message::where("category",$message->category)->get();
        if(Auth::id() == $message->recipient->id)
        {
        $message->update([
            "read" => 1,
        ]);
        }
        $view = view("message.show");
        $view->message = $message;
        $view->previous_messages = $previous_messages;
        return $view;

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        return view('message.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        //
    }

    //Show sent messages

    public function sent()
    {
        $view = view("message.sent");
        $messages = Message::where("sender_id",Auth::id())->latest()->get();
        $view->messages = $messages;
        return $view;
    }
    public function respond($id)
    {
        $message = Message::find($id);
        $previous_messages = Message::where("category",$message->category)->get();
        return view('message.respond', ['message' => $message, "previous_messages" => $previous_messages]);
    }
    public function respond_store(Request $request)
    {
        $this->validate($request, [
            "text" => "required",
        ]);


        $message = Message::create([
            "title" => $request->input("title"),
            "text" => $request->input("text"),
            'sender_id' => Auth::id(),
            'recipient_id' => $request->input("recipient_id"),
            'read' => 0,
            "category" => $request->input("category"),
        ]);


        session()->flash('success_message', 'Message Sent!');

        return redirect()->action("MessageController@sent", ['id' => Auth::id()])->with("success", "Message sent!");
    }
}