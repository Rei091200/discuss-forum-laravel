<?php

namespace App\Http\Controllers;

use App\Thread;
use Illuminate\Http\Request;

class ThreadsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $threads = Thread::orderBy('created_at','desc')->paginate(10);
        // dd($threads);
        return view('threads.index')->with('threads', $threads);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required'
        ]);

        $thread = new Thread;
        $thread->question = $request->question;
        $thread->user_id = auth()->user()->id;
        $thread->save();
        return redirect('/threads')->with('status', 'Thread baru sudah ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $thread = Thread::find($id);
        return view('threads.show')->with('thread', $thread);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $thread = Thread::find($id);

        // Check authorized user
        if(auth()->user()->id !== $thread->user->id) {
            return redirect('/threads');
        }
        
        return view('threads.edit')->with('thread', $thread);
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
        Thread::where('id', $id)
                ->update(['question' => $request->question]);
        return redirect('/threads')->with('status', 'Thread sudah diubah!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thread = Thread::find($id);
        // Check authorized user
        if(auth()->user()->id !== $thread->user->id) {
            return redirect('/threads');
        }
        
        Thread::destroy($id);
        return redirect('/threads')->with('status', 'Thread sudah dihapus!');
    }
}
