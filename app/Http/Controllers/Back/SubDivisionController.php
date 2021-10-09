<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubDivision;
use Alert;
class SubDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return redirect()->back();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkSubDivisionName(Request $request) 
    {
        if($request->Input('sub_division_name')){
            $sub_division_name = SubDivision::where('name',$request->Input('sub_division_name'))->first();
            if($sub_division_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_sub_division_name')){
            $edit_sub_division_name = SubDivision::where('name',$request->Input('edit_sub_division_name'))->first();
            if($edit_sub_division_name){
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
            'name' => $request->sub_division_name,
            'description' => $request->sub_division_description,
        ];

        SubDivision::create($data)
        ? Alert::success('Berhasil', 'Sub Divisi telah berhasil ditambahkan!')
        : Alert::error('Error', 'Sub Divisi gagal ditambahkan!');

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
        $sub_division = SubDivision::findOrFail($id);

        $data = [
            'name' => $request->edit_sub_division_name ? $request->edit_sub_division_name : $sub_division->name,
            'description' => $request->edit_sub_division_description ? $request->edit_sub_division_description : $sub_division->description, 
        ];

        $sub_division->update($data)
        ? Alert::success('Berhasil', "Sub Divisi telah berhasil diubah!")
        : Alert::error('Error', "Sub Divisi gagal diubah!");

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
        $sub_division = SubDivision::findOrFail($id);
       
        $sub_division->delete()
            ? Alert::success('Berhasil', "Sub Divisi telah berhasil dihapus.")
            : Alert::error('Error', "Sub Divisi gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll()
    {
        $sub_division = SubDivision::all();

        foreach($sub_division as $sub_divisions) {
            $sub_divisions->delete();
        }

        (count(SubDivision::all()) <= 1)
        ? Alert::success('Berhasil', "Semua Sub Divisi telah berhasil dihapus.")
        : Alert::error('Error', "Sub Divisi gagal dihapus!");

        return redirect()->back();
    }
}
