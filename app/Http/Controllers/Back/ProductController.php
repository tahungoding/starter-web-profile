<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Web;
use Alert;
use Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['product'] = Product::paginate(6);
        $data['allProduct'] = Product::all();
        $data['web'] = Web::all();
        return view('back.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    function productSearch(Request $request)
    {
        $search_val = $request->search;
        if($request->ajax()){
            $product_result = Product::where('name','LIKE',"%{$search_val}%")->limit(6)->get();
            return view('back.product.search', compact('product_result'))->render();
        }
    }

    function productPagination(Request $request)
    {
        if($request->ajax()) {
            $product = Product::paginate(6);
            return view('back.product.pagination', compact('product'))->render();
        }
    }

    public function checkProductName(Request $request) 
    {
        if($request->Input('product_name')){
            $product_name = Product::where('name',$request->Input('product_name'))->first();
            if($product_name){
                return 'false';
            }else{
                return  'true';
            }
        }

        if($request->Input('edit_product_name')){
            $edit_product_name = Product::where('name',$request->Input('edit_product_name'))->first();
            if($edit_product_name){
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
        $image = ($request->product_image) ? $request->file('product_image')->store("/public/input/products") : null;
        
        $data = [
            'name' => $request->product_name,
            'description' => $request->product_description,
            'youtube' => $request->product_youtube,
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
        if($request->hasFile('edit_product_image')) {
            if(Storage::exists($product->image) && !empty($product->image)) {
                Storage::delete($product->image);
            }

            $edit_image = $request->file("edit_product_image")->store("/public/input/products");
        }
        $data = [
            'name' => $request->edit_product_name ? $request->edit_product_name : $product->name,
            'description' => $request->edit_product_description ? $request->edit_product_description : $product->description,
            'youtube' => $request->edit_product_youtube ? $request->edit_product_youtube : $product->youtube,
            'image' => $request->hasFile('edit_product_image') ? $edit_image : $product->image,
           
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

    public function destroyAll(Request $request)
    {
        if(empty($request->id)) {
            Alert::info('Info', "Tidak ada product yang dipilih.");
            return redirect()->back();
        } else {
            $product = $request->id;
        
            foreach($product as $products) {
                Product::where('id', $products)->delete()
                ? Alert::success('Berhasil', "Semua Product yang dipilih telah berhasil dihapus.")
                : Alert::error('Error', "Product gagal dihapus!");
            }
               
    
            return redirect()->back();
        }
        
    }
}
