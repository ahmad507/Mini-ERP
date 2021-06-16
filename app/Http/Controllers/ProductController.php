<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Storage;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::select('id','item_code','barcode','qty','storage_id','operator')->orderBy('item_code','asc')->get();
        $storages = Storage::with('products')->orderBy('id','asc')->get();
        return view('products.index', compact('products','storages'));
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
        $validator = Validator::make($request->all(), [
            'item_code' => 'required',
            'barcode' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::warning('Masukan Salah', 'Pastikan Produk Telah Terisi Lengkap');
            return redirect()->route('orders')->withSuccessMessage('Pastikan Data Produk Telah Terisi Lengkap');
        }
        ['`item_code`, `barcode`, `qty`, `storage_id`, `operator`'];
       $data = new Product;
       $data->item_code = $request->item_code;
       $data->barcode = $request->barcode;
       $data->qty = $request->qty;
       $data->storage_id = $request->storage_id;
       $data->operator = $request->operator;
       $data->save();
       Alert::success('Produk', 'Ditambahkan');
       return redirect()->route('orders')->withSuccessMessage('Produk Berhasil Ditambah');
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
    public function update(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'item_code' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::warning('Masukan Salah', 'Pastikan Data Produk Telah Terisi Lengkap');
            return back()->withSuccessMessage('Pastikan Data Produk Telah Terisi Lengkap');
        }
        
        $product = Product::findOrfail($request->id);
        $product->item_code = $request->item_code;
        $product->barcode = $request->barcode;
        $product->qty = $request->qty;
        $product->storage_id = $request->storage_id;
        $product->operator = $request->operator;
        $product->save();
        Alert::success('Material', 'Dipindahkan');
        return redirect()->route('products')->withSuccessMessage('Material Berhasil Dipindah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
