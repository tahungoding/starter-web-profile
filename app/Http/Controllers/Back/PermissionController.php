<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Alert;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['permission'] = Permission::all();
        return view('back.hak_akses.permission', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        $new = Permission::create(['name' => $request->name, 'guard_name' => 'web']);

        $new->syncPermissions($request->permission)
        ? Alert::success('Berhasil', 'Permission telah berhasil ditambahkan!')
        : Alert::error('Error', 'Permission gagal ditambahkan!');

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
        $permission = Permission::findOrFail($id);
       
        $permission->delete()
            ? Alert::success('Berhasil', "Permission telah berhasil dihapus.")
            : Alert::error('Error', "Permission gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll()
    {
        $permission = Permission::all();

        foreach($permission as $permissions) {
            $permissions->delete();
        }

        (count(Permission::all()) <= 1)
        ? Alert::success('Berhasil', "Permission telah berhasil dihapus.")
        : Alert::error('Error', "Permission gagal dihapus!");

        return redirect()->back();
    }
}
