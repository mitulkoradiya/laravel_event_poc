<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventCreateRequest;
use App\Http\Requests\EventUpdateRequest;
use App\Models\Event;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::with('type')->orderBy('id','desc')->paginate(10);
        return view('event.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('event.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventCreateRequest $request)
    {
        $path = Storage::put('public/image',$request->file('image'));
        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'type_id' => $request->type,
            'image' => $path,
        ]);
        return redirect()->route('events.index')->with('success','Event has Been Created successfully');
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
    public function edit(Event $event)
    {
        $types = Type::all();
        return view('event.edit',compact('event', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventUpdateRequest $request,Event $event)
    {
        $event->name = $request->name;
        $event->description = $request->description;
        $event->type_id = $request->type;
        if($request->hasFile('image')){
            Storage::delete($event->image);
            $path = Storage::put('public/image',$request->file('image'));
            $event->image = $path;
        }
        $event->save();
        return redirect()->route('events.index')->with('success','Events has Been updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        Storage::delete($event->image);
        $event->delete();
        return redirect()->route('events.index')->with('success','Event has been deleted successfully');
    }
}
