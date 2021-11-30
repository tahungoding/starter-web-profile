<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Web;
use Storage;
use Alert;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['event'] = Event::paginate(6);
        $data['allEvent'] = Event::all();
        $data['web'] = Web::all();
        return view('back.event.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function eventSearch(Request $request)
    {
        $search_val = $request->search;
        if($request->ajax()){
            $event_result = Event::where('name','LIKE',"%{$search_val}%")->limit(6)->get();
            return view('back.event.search', compact('event_result'))->render();
        }
    }

    function eventPagination(Request $request)
    {
        if($request->ajax()) {
            $event = Event::paginate(6);
            return view('back.event.pagination', compact('event'))->render();
        }
    }

    public function checkEventName(Request $request) 
    {
        if($request->Input('event_name')){
            $event_name = Event::where('name',$request->Input('event_name'))->first();
            if($event_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_event_name')){
            $edit_event_name = Event::where('name',$request->Input('edit_event_name'))->first();
            if($edit_event_name){
                return 'false';
            }else{
                return  'true';
            }
        }
    }

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
    public function store(Request $request)
    {
        $image = ($request->event_image) ? $request->file('event_image')->store("/public/input/events") : null;
        
        $data = [
            'name' => $request->event_name,
            'description' => $request->event_description,
            'image' => $image,
            'youtube' => $request->event_youtube,
            'date' => $request->event_date,
            'location' => $request->event_location,
        ];

        Event::create($data)
        ? Alert::success('Berhasil', 'Event telah berhasil ditambahkan!')
        : Alert::error('Error', 'Event gagal ditambahkan!');

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
        $event = Event::findOrFail($id);
        if($request->hasFile('edit_event_image')) {
            if(Storage::exists($event->image) && !empty($event->image)) {
                Storage::delete($event->image);
            }

            $edit_image = $request->file("edit_event_image")->store("/public/input/events");
        }
        $data = [
            'name' => $request->edit_event_name ? $request->edit_event_name : $event->name,
            'description' => $request->edit_event_description ? $request->edit_event_description : $event->description,
            'image' => $request->hasFile('edit_event_image') ? $edit_image : $event->image,
            'youtube' => $request->edit_event_youtube ? $request->edit_event_youtube : $event->youtube,
            'date' => $request->edit_event_date ? $request->edit_event_date : $event->date,
            'location' => $request->edit_event_location ? $request->edit_event_location : $event->location,
           
        ];

        $event->update($data)
        ? Alert::success('Berhasil', "Event telah berhasil diubah!")
        : Alert::error('Error', "Event gagal diubah!");

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::findOrFail($id);
       
        $event->delete()
            ? Alert::success('Berhasil', "Event telah berhasil dihapus.")
            : Alert::error('Error', "Event gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll(Request $request)
    {
        if(empty($request->id)) {
            Alert::info('Info', "Tidak ada event yang dipilih.");
            return redirect()->back();
        } else {
            $event = $request->id;
        
            foreach($event as $events) {
                Event::where('id', $events)->delete()
                ? Alert::success('Berhasil', "Semua Event yang dipilih telah berhasil dihapus.")
                : Alert::error('Error', "Event gagal dihapus!");
            }
               
            return redirect()->back();
        }
        
    }
}
