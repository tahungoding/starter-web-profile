<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\Web;
use Alert;
use Storage;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['banner'] = Banner::all();
        $data['web'] = Web::all();
        return view('back.banner.index', $data);
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
        $image = $request->file('banner_image')->store('/public/input/banners');

        $data = [
            'image' => $image,
            'url' => $request->banner_url
        ];

        Banner::create($data)
        ? Alert::success('Berhasil', 'Banner telah berhasil ditambahkan!')
        : Alert::error('Error', 'Banner gagal ditambahkan!');

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
        $banner = Banner::findOrFail($id);
        if($request->hasFile('edit_banner_image')) {
            if(Storage::exists($banner->image) && !empty($banner->image)) {
                Storage::delete($banner->image);
            }

            $edit_image = $request->file('edit_banner_image')->store('/public/input/banners');
        }
        $data = [
            'image' => $request->hasFile('edit_banner_image') ? $edit_image : $banner->image, 
            'url' => $request->edit_banner_url ? $request->edit_banner_url : $banner->url, 
        ];

        $banner->update($data)
        ? Alert::success('Berhasil', "Banner telah berhasil diubah!")
        : Alert::error('Error', "Banner gagal diubah!");

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
        $banner = Banner::findOrFail($id);
       
        $banner->delete()
            ? Alert::success('Berhasil', "Banner telah berhasil dihapus.")
            : Alert::error('Error', "Banner gagal dihapus!");

        return redirect()->back();
    }

    public function destroyAll()
    {
        $banner = Banner::all();

        foreach($banner as $banners) {
            $banners->delete();
        }

        (count(Banner::all()) <= 1)
        ? Alert::success('Berhasil', "Banner telah berhasil dihapus.")
        : Alert::error('Error', "Banner gagal dihapus!");

        return redirect()->back();
    }
}
