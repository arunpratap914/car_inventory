<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Car;
use App\Manufacturer;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mfgs = Manufacturer::all()->where('status', 1);
        return view('add_model',['mfgs'=>$mfgs]);
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
            'color'=>'required|alpha|max:20',
            'mfg'=>'required|numeric',
            'model_name'=>'required|max:50',
            'mfg_year'=>'required|numeric',
            'reg_num'=>'required|alpha_num|max:50',
            'note'=>'required|max:191',
            'pic1'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pic2'=>'required|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($validator->passes()) {
            $image1 = $request->file('pic1');
            $image1_name = time() . '.' . $image1->getClientOriginalExtension();
            $image1->move(public_path('cars/images'), $image1_name);

            $image2 = $request->file('pic2');
            $image2_name = time() . '.' . $image2->getClientOriginalExtension();
            $image2->move(public_path('cars/images'), $image2_name);



            $mfg = new Car;
            $mfg->color = $request->color;
            $mfg->manufacturer_id	 = $request->mfg;
            $mfg->name = $request->model_name;
            $mfg->mfg_year = $request->mfg_year;
            $mfg->reg_num = $request->reg_num;
            $mfg->note = $request->note;
            $mfg->pic1 = $image1_name;
            $mfg->pic2 = $image2_name;
            $mfg->save();
			return response()->json(['msg' => 'added', 'success' =>1]);
        }


    	return response()->json(['error'=>$validator->errors()->all()]);
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
        //
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
