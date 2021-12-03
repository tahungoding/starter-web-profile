<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jasa;
use App\Models\Web;
use Alert;
use Storage;

class JasaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['jasa'] = Jasa::paginate(6);
        $data['allJasa'] = Jasa::all();
        $data['web'] = Web::all();
        return view('back.jasa.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function jasaSearch(Request $request)
    {
        $search_val = $request->search;
        if($request->ajax()){
            $jasa_result = Jasa::where('name','LIKE',"%{$search_val}%")->limit(6)->get();
            return view('back.jasa.search', compact('jasa_result'))->render();
        }
    }

    function jasaPagination(Request $request)
    {
        if($request->ajax()) {
            $jasa = Jasa::paginate(6);
            return view('back.jasa.pagination', compact('jasa'))->render();
        }
    }

    public function checkJasaName(Request $request) 
    {
        if($request->Input('jasa_name')){
            $jasa_name = Jasa::where('name',$request->Input('jasa_name'))->first();
            if($jasa_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_jasa_name')){
            $edit_jasa_name = Jasa::where('name',$request->Input('edit_jasa_name'))->first();
            if($edit_jasa_name){
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
        $image = ($request->jasa_image) ? $request->file('jasa_image')->store("/public/input/jasa") : null;
        
        $data = [
            'name' => $request->jasa_name,
            'description' => $request->jasa_description,
            'image' => $image
        ];

        Jasa::create($data)
        ? Alert::success('Berhasil', 'Jasa telah berhasil ditambahkan!')
        : Alert::error('Error', 'Jasa gagal ditambahkan!');

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
        $jasa = Jasa::findOrFail($id);
        if($request->hasFile('edit_jasa_image')) {
            if(Storage::exists($jasa->image) && !empty($jasa->image)) {
                Storage::delete($jasa->image);
            }

            $edit_image = $request->file("edit_jasa_image")->store("/public/input/jasa");
        }
        $data = [
            'name' => $request->edit_jasa_name ? $request->edit_jasa_name : $jasa->name,
            'description' => $request->edit_jasa_description ? $request->edit_jasa_description : $jasa->description,
            'image' => $request->hasFile('edit_jasa_image') ? $edit_image : $jasa->image,
           
        ];

        $jasa->update($data)
        ? Alert::success('Berhasil', "Jasa telah berhasil diubah!")
        : Alert::error('Error', "Jasa gagal diubah!");

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
        $jasa = Jasa::findOrFail($id);
       
        $jasa->delete()
            ? Alert::success('Berhasil', "Jasa telah berhasil dihapus.")
            : Alert::error('Error', "Jasa gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll(Request $request)
    {
        if(empty($request->id)) {
            Alert::info('Info', "Tidak ada jasa yang dipilih.");
            return redirect()->back();
        } else {
            $jasa = $request->id;
        
            foreach($jasa as $allJasa) {
                Jasa::where('id', $allJasa)->delete()
                ? Alert::success('Berhasil', "Semua Jasa yang dipilih telah berhasil dihapus.")
                : Alert::error('Error', "Jasa gagal dihapus!");
            }
               
    
            return redirect()->back();
        }
        
    }
}
