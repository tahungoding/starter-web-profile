<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimony;
use App\Models\Web;
use Alert;
use Storage;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['testimony'] = Testimony::paginate(6);
        $data['allTestimony'] = Testimony::all();
        $data['web'] = Web::all();
        return view('back.testimony.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function testimonySearch(Request $request)
    {
        $search_val = $request->search;
        if($request->ajax()){
            $testimony_result = Testimony::where('name','LIKE',"%{$search_val}%")->limit(6)->get();
            return view('back.testimony.search', compact('testimony_result'))->render();
        }
    }

    function testimonyPagination(Request $request)
    {
        if($request->ajax()) {
            $testimony = Testimony::paginate(6);
            return view('back.testimony.pagination', compact('testimony'))->render();
        }
    }

    public function checkTestimonyName(Request $request) 
    {
        if($request->Input('testimony_name')){
            $testimony_name = Testimony::where('name',$request->Input('testimony_name'))->first();
            if($testimony_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_testimony_name')){
            $edit_testimony_name = Testimony::where('name',$request->Input('edit_testimony_name'))->first();
            if($edit_testimony_name){
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
        $image = ($request->testimony_image) ? $request->file('testimony_image')->store("/public/input/testimonies") : null;
        
        $data = [
            'name' => $request->testimony_name,
            'description' => $request->testimony_description,
            'image' => $image
        ];

        Testimony::create($data)
        ? Alert::success('Berhasil', 'Testimony telah berhasil ditambahkan!')
        : Alert::error('Error', 'Testimony gagal ditambahkan!');

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
        $testimony = Testimony::findOrFail($id);
        if($request->hasFile('edit_testimony_image')) {
            if(Storage::exists($testimony->image) && !empty($testimony->image)) {
                Storage::delete($testimony->image);
            }

            $edit_image = $request->file("edit_testimony_image")->store("/public/input/testimonies");
        }
        $data = [
            'name' => $request->edit_testimony_name ? $request->edit_testimony_name : $testimony->name,
            'description' => $request->edit_testimony_description ? $request->edit_testimony_description : $testimony->description,
            'image' => $request->hasFile('edit_testimony_image') ? $edit_image : $testimony->image,
           
        ];

        $testimony->update($data)
        ? Alert::success('Berhasil', "Testimony telah berhasil diubah!")
        : Alert::error('Error', "Testimony gagal diubah!");

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
        $testimony = Testimony::findOrFail($id);
       
        $testimony->delete()
            ? Alert::success('Berhasil', "Testimony telah berhasil dihapus.")
            : Alert::error('Error', "Testimony gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll(Request $request)
    {
        if(empty($request->id)) {
            Alert::info('Info', "Tidak ada testimony yang dipilih.");
            return redirect()->back();
        } else {
            $testimony = $request->id;
        
            foreach($testimony as $allTestimony) {
                Testimony::where('id', $allTestimony)->delete()
                ? Alert::success('Berhasil', "Semua Testimony yang dipilih telah berhasil dihapus.")
                : Alert::error('Error', "Testimony gagal dihapus!");
            }
            
            return redirect()->back();
        }
        
    }
}
