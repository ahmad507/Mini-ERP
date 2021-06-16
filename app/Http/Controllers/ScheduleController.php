<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
use App\Models\Cutting;
use App\Models\Material;
use App\Models\Sudut;
use App\Models\Classes;
use Validator;
use PDF;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;


class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

        $machine = ['DBB1','DBB2','DBB3','DBB4','KBB1','KBB2','KBB3','NON-ALC'];
        
        $dataSch = DB::table('schedules')
        ->select(DB::raw('sum(sch) as ttl'))
        ->where('cutting_id','<>',0)
        ->groupBy('cutting_id')
        ->pluck('ttl');
        $schedules = Schedule::select('id','cutting_id','treatment','sudut','class','stock','empty','sch','act','position')->orderBy('empty','asc')->get();
        $cuttings = Cutting::with('schedules')->orderBy('position','asc')->get();
        $materials = Material::all()->pluck('treatment', 'treatment')->prepend(trans('Material'), '');
        $suduts = Sudut::all()->pluck('sudut', 'sudut')->prepend(trans('Angle'), '');
        $classes = Classes::all()->pluck('class', 'class')->prepend(trans('Class'), '');
        return view('schedules.index', compact('dataSch','schedules','cuttings','materials','suduts','classes'))->with('machine',json_encode($machine,JSON_NUMERIC_CHECK));
    
    }

    public function print_pdf()
    {   
        $schedules = Schedule::all();
        $cuttings = Cutting::with('schedules')->orderBy('position','asc')->get();
        $pdf = PDF::loadView('print', compact('schedules','cuttings'));
        return $pdf->stream();
    
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       

        
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
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            Alert::warning('Masukan Salah', 'Pastikan Data Schedule Telah Terisi Lengkap');
            return redirect()->route('schedules')->withSuccessMessage('Pastikan Data Schedule Telah Terisi Lengkap');
        }

       $data = new Schedule;
       $data->code = $request->code;
       $data->cutting_id = $request->cutting_id;
       $data->treatment = $request->treatment;
       $data->sudut = $request->sudut;
       $data->class = $request->class;
       $data->stock = $request->stock;
       $data->empty = $request->empty;
       $data->sch = $request->sch;
       $data->act = $request->act;
       $data->position = $request->position;
       $data->save();
       Alert::success('Schadeule', 'Ditambahkan');
       return redirect()->route('schedules')->withSuccessMessage('Schedule Berhasil Ditambah');
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

    $schedule = Schedule::findOrfail($request->id);
    $schedule->code = $request->code;
    $schedule->cutting_id = $request->cutting_id;
    $schedule->treatment = $request->treatment;
    $schedule->sudut = $request->sudut;
    $schedule->class = $request->class;
    $schedule->stock = $request->stock;
    $schedule->empty = $request->empty;
    $schedule->sch = $request->sch;
    $schedule->act = $request->act;
    $schedule->position = $request->position;
    $schedule->save();
    Alert::success('Schadeule', 'Dipindahkan');
    return redirect()->route('schedules')->withSuccessMessage('Schedule Berhasil Dipindah');
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
    public function getData()
    {
        
    
        //dd($result->all());
      
    }
}
