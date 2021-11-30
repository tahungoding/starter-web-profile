<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Web;
use Storage;
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
        $data['allProject'] = Project::all();
        $data['web'] = Web::all();
        return view('back.project.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function searchProject(Request $request)
    {
        $search_val = $request->search;
        if($request->ajax()){
            $project_result = Project::where('name','LIKE',"%{$search_val}%")->limit(6)->get();
            return view('back.project.search', compact('project_result'))->render();
        }
    }

    function projectPagination(Request $request)
    {
        if($request->ajax()) {
            $project = Project::paginate(6);
            return view('back.project.pagination', compact('project'))->render();
        }
    }

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

        if($request->Input('edit_project_name')){
            $edit_project_name = Project::where('name',$request->Input('edit_project_name'))->first();
            if($edit_project_name){
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
        $image = ($request->project_image) ? $request->file('project_image')->store("/public/input/projects") : null;
        
        $data = [
            'name' => $request->project_name,
            'description' => $request->project_description,
            'youtube' => $request->project_youtube,
            'date_start' => $request->project_date_start,
            'date_end' => $request->project_date_end,
            'image' => $image,
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
        if($request->hasFile('edit_project_image')) {
            if(Storage::exists($project->image) && !empty($project->image)) {
                Storage::delete($project->image);
            }

            $edit_image = $request->file("edit_project_image")->store("/public/input/projects");
        }
        $data = [
            'name' => $request->edit_project_name ? $request->edit_project_name : $project->name,
            'description' => $request->edit_project_description ? $request->edit_project_description : $project->description,
            'youtube' => $request->edit_project_youtube ? $request->edit_project_youtube : $project->youtube,
            'date_start' => $request->edit_project_date_start ? $request->edit_project_date_start : $project->date_start,
            'date_end' => $request->edit_project_date_end ? $request->edit_project_date_end : $project->date_end,
            'image' => $request->hasFile('edit_project_image') ? $edit_image : $project->image,
           
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

    public function destroyAll(Request $request)
    {
        if(empty($request->id)) {
            Alert::info('Info', "Tidak ada project yang dipilih.");
            return redirect()->back();
        } else {
            $project = $request->id;
        
            foreach($project as $projects) {
                Project::where('id', $projects)->delete()
                ? Alert::success('Berhasil', "Semua Project yang dipilih telah berhasil dihapus.")
                : Alert::error('Error', "Project gagal dihapus!");
            }
               
    
            return redirect()->back();
        }
        
    }
}
