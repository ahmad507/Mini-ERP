<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\Kanban;
use App\Models\Storage;
use Illuminate\Support\Facades\DB;
use Validator;
use RealRashid\SweetAlert\Facades\Alert;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

       
        $data = DB::table('orders')->select(DB::raw('sum(flag) as ttl'))->where('kanban_id','<>',0)->groupBy('kanban_id')->pluck('ttl');
        $kanbans = Kanban::with('orders')->orderBy('id','asc')->get();
        $orders = Order::select('id','item_code','qty','machine_bld','oprt','kanban_id','flag','note','created_at')->orderBy('id','desc')->get();
        return view('orders.index', compact('orders','kanbans','data'));
        //dd($location->all());
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
        ]);

        if ($validator->fails()) {
            Alert::warning('Masukan Salah', 'Pastikan Data Order Telah Terisi Lengkap');
            return redirect()->route('orders')->withSuccessMessage('Pastikan Data Order Telah Terisi Lengkap');
        }
       
       $data = new Order;
       $data->item_code = $request->item_code;
       $data->qty = $request->qty;
       $data->machine_bld = $request->machine_bld;
       $data->oprt = $request->oprt;
       $data->kanban_id = $request->kanban_id;
       $data->flag = $request->flag;
       $data->created_at = $request->created_at;
       $data->note = $request->note;
       $data->save();
       Alert::success('Order', 'Ditambahkan');
       return redirect()->route('orders')->withSuccessMessage('Order Berhasil Ditambah');
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
            'kanban_id' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::warning('Masukan Salah', 'Pastikan Data Order Telah Terisi Lengkap');
            return redirect()->route('orders')->withSuccessMessage('Pastikan Data Order Telah Terisi Lengkap');
        }


        $order = Order::findOrfail($request->id);
        $order->item_code = $request->item_code;
        $order->qty = $request->qty;
        $order->machine_bld = $request->machine_bld;
        $order->oprt = $request->oprt;
        $order->kanban_id = $request->kanban_id;
        $order->note = $request->note;
        $order->created_at = $request->created_at;
        $order->save();
        Alert::success('Status Order', 'Diperbarui');
        return redirect()->route('orders')->withSuccessMessage('Status Order Berhasil Diperbarui');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $orders = Order::findOrFail($request->id);
        $orders->delete();
        Alert::success('Data Order', 'Berhasil Di Hapus');
        return redirect()->route('orders')->withSuccessMessage('Data Order Berhasil Dihapus');
        //dd($request->id);
    }
    public function req()
    {
        $dataOrder = DB::table('orders')
        ->where('kanban_id','=',3)
        ->orderBy('kanban_id')
        ->get();

        $data = DB::table('orders')
        ->select(DB::raw('sum(flag) as ttl'))
        ->where('kanban_id','<>',0)
        ->groupBy('kanban_id')
        ->pluck('ttl');

        $location = Storage::all()->pluck('location', 'id')->prepend(trans('Storage'), '');
        $kanbans = Kanban::with('orders')->orderBy('id','asc')->get();
        $orders = Order::select('id','item_code','qty','machine_bld','oprt','kanban_id','flag','note','created_at')->orderBy('id','desc')->get();
        return view('orders.req', compact('orders','kanbans','data','dataOrder','location'));
        //dd($dataOrder->all());
    }

}
