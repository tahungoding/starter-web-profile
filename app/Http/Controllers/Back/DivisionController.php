<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\SubDivision;
use Alert;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['division'] = Division::all();
        $data['sub_division'] = SubDivision::all();
        return view('back.division.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkDivisionName(Request $request) 
    {
        if($request->Input('division_name')){
            $division_name = Division::where('name',$request->Input('division_name'))->first();
            if($division_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_division_name')){
            $edit_division_name = Division::where('name',$request->Input('edit_division_name'))->first();
            if($edit_division_name){
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
        $data = [
            'name' => $request->division_name,
            'description' => $request->division_description,
        ];

        Division::create($data)
        ? Alert::success('Berhasil', 'Divisi telah berhasil ditambahkan!')
        : Alert::error('Error', 'Divisi gagal ditambahkan!');

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
        $division = Division::findOrFail($id);

        $data = [
            'name' => $request->edit_division_name ? $request->edit_division_name : $division->name,
            'description' => $request->edit_division_description ? $request->edit_division_description : $division->description, 
        ];

        $division->update($data)
        ? Alert::success('Berhasil', "Divisi telah berhasil diubah!")
        : Alert::error('Error', "Divisi gagal diubah!");

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
        $division = Division::findOrFail($id);
       
        $division->delete()
            ? Alert::success('Berhasil', "Divisi telah berhasil dihapus.")
            : Alert::error('Error', "Divisi gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll()
    {
        $division = Division::all();

        foreach($division as $divisions) {
            $divisions->delete();
        }

        (count(Division::all()) <= 1)
        ? Alert::success('Berhasil', "Semua Divisi telah berhasil dihapus.")
        : Alert::error('Error', "Divisi gagal dihapus!");

        return redirect()->back();
    }
}
