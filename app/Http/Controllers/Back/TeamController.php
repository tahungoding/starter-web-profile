<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Division;
use App\Models\SubDivision;
use App\Models\Web;
use Storage;
use Alert;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['team'] = Team::all();
        $data['web'] = Web::all();
        return view('back.team.index', $data);
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
        $photo = ($request->team_photo) ? $request->file('team_photo')->store("/public/input/teams") : null;
        
        $data = [
            'fullname' => $request->team_fullname,
            'photo' => $photo,
            'position' => $request->team_position,
        ];

        Team::create($data)
        ? Alert::success('Berhasil', 'Team telah berhasil ditambahkan!')
        : Alert::error('Error', 'Team gagal ditambahkan!');

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
        $team = Team::findOrFail($id);
        if($request->hasFile('edit_team_photo')) {
            if(Storage::exists($team->photo) && !empty($team->photo)) {
                Storage::delete($team->photo);
            }

            $edit_photo = $request->file('edit_team_photo')->store('/public/input/teams');
        }
        $data = [
            'fullname' => $request->edit_team_fullname ? $request->edit_team_fullname : $team->fullname, 
            'photo' => $request->hasFile('edit_team_photo') ? $edit_photo : $team->photo, 
            'position' => $request->edit_team_position ? $request->edit_team_position : $team->position, 
        ];

        $team->update($data)
        ? Alert::success('Berhasil', "Team telah berhasil diubah!")
        : Alert::error('Error', "Team gagal diubah!");

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
        $team = Team::findOrFail($id);
       
        $team->delete()
            ? Alert::success('Berhasil', "Team telah berhasil dihapus.")
            : Alert::error('Error', "Team gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll()
    {
        $team = Team::all();

        foreach($team as $teams) {
            $teams->delete();
        }

        (count(Team::all()) <= 1)
        ? Alert::success('Berhasil', "Semua Team telah berhasil dihapus.")
        : Alert::error('Error', "Team gagal dihapus!");

        return redirect()->back();
    }
}
