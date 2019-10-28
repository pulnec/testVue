<?php

namespace App\Http\Controllers;

use App\Pensamientos;
use Illuminate\Http\Request;

class PensamientosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Pensamientos::where('user_id',auth()->id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $pensamientos = new Pensamientos();
        $pensamientos->descripcion = $request->descripcion;
        $pensamientos->user_id = auth()->id();
        $pensamientos->save();

        return $pensamientos;
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
        $pensamientos = Pensamientos::find($id);
        $pensamientos->descripcion = $request->descripcion;
        $pensamientos->save();
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
        $pensamientos = Pensamientos::find($id);
        $pensamientos->delete();
    }
}
