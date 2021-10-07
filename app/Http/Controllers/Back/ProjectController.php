<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Alert;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['project'] = Project::paginate(6);
        return view('back.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function checkProjectName(Request $request) 
    {
        if($request->Input('project_name')){
            $project_name = Project::where('name',$request->Input('project_name'))->first();
            if($project_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        // if($request->Input('edit_tahun')){
        //     $edit_tahun = Recruitment::where('tahun',$request->Input('edit_tahun'))->first();
        //     if($edit_tahun){
        //         return 'false';
        //     }else{
        //         return  'true';
        //     }
        // }
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
        $image = ($request->project_image) ? $request->file('project_image')->store("/public/input/projects") : null;
        
        $data = [
            'name' => $request->project_name,
            'description' => $request->project_description,
            'youtube' => $request->project_youtube,
            'image' => $image,
            'date_start' => $request->project_date_start,
        ];

        Project::create($data)
        ? Alert::success('Berhasil', 'Produk telah berhasil ditambahkan!')
        : Alert::error('Error', 'Produk gagal ditambahkan!');
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
        $project = Project::findOrFail($id);
        if($request->hasFile('edit_image')) {
            if(Storage::exists($project->image) && !empty($project->image)) {
                Storage::delete($project->image);
            }

            $edit_image = $request->file("edit_image")->store("/public/input/projects");
        }
        $data = [
            'name' => $request->edit_name ? $request->edit_name : $project->name,
            'description' => $request->edit_description ? $request->edit_description : $project->description,
            'youtube' => $request->edit_youtube ? $request->edit_youtube : $project->youtube,
            'image' => $request->hasFile('edit_image') ? $edit_image : $project->image,
           
        ];

        $project->update($data)
        ? Alert::success('Berhasil', "Project telah berhasil diubah!")
        : Alert::error('Error', "Project gagal diubah!");

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
        $project = Project::findOrFail($id);
       
        $project->delete()
            ? Alert::success('Berhasil', "Project telah berhasil dihapus.")
            : Alert::error('Error', "Project gagal dihapus!");

        return redirect()->back();
    }
}
