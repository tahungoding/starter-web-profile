<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::all();
        return view('back.product.index', $data);
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
        $image = ($request->image) ? $request->file('image')->store("/public/input/products") : null;
        
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'youtube' => $request->youtube,
            'image' => $image
        ];

        Product::create($data)
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
        $product = Product::findOrFail($id);
        if($request->hasFile('edit_image')) {
            if(Storage::exists($product->image) && !empty($product->image)) {
                Storage::delete($product->image);
            }

            $edit_image = $request->file("edit_image")->store("/public/input/products");
        }
        $data = [
            'name' => $request->edit_name ? $request->edit_name : $product->name,
            'description' => $request->edit_description ? $request->edit_description : $product->description,
            'youtube' => $request->edit_youtube ? $request->edit_youtube : $product->youtube,
            'image' => $request->hasFile('edit_image') ? $edit_image : $product->image,
           
        ];

        $product->update($data)
        ? Alert::success('Berhasil', "Produk telah berhasil diubah!")
        : Alert::error('Error', "Produk gagal diubah!");

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
        $product = Product::findOrFail($id);
       
        $product->delete()
            ? Alert::success('Berhasil', "Product telah berhasil dihapus.")
            : Alert::error('Error', "Product gagal dihapus!");

        return redirect()->back();
    }
}
