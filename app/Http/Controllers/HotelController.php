<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hotel;

class HotelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Hotel::all();

        return response()->json([
            "message"=>"load data success",
            "data"=>$data],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $table = Hotel::create([
            "roomnumber" =>$request->roomnumber,
            "roomtype" =>$request->roomtype,
            "bookedby" =>$request->bookedby,
            "status" =>$request->status
        ]);
        return response()->json([
            "message"=> "store success",
            "data"=>$table],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $table = Hotel::find($id);
        if($table){
            return response()->json([
                "message"=>"data found",
                "data" => $table
            ],201);
        }else{
            return["message"=>"data not found"];
        }
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
        $table = Hotel::find($id);
        if($table){
          $table->roomnumber = $request->roomnumber ? $request->roomnumber : $table->roomnumber;
          $table->roomtype = $request->roomtype ? $request->roomtype : $table->roomntype;
          $table->bookedby = $request->bookedby ? $request->bookedby : $table->bookedby;
          $table->status = $request->status ? $request->status : $table->status;  
          $table->save();

          return response()->json([
                "message"=>"data found",
                "data" => $table
            ],201);;
        }else{
            return ["message"=>"data not found"];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $table = Hotel::find($id);
        if($table){
            $table->delete();
            return ["message"=>"delete success"];
        }else{
            return ["message"=>"data not found"];
        }
    }
}
