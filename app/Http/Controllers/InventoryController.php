<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Car;
use App\Manufacturer;

class InventoryController extends Controller
{
    public function index(){
        $cars = Car::all()->where('status',1);
        $ccr = DB::table('manufacturers')
        ->join('cars', 'manufacturers.id', '=', 'cars.manufacturer_id')
        ->select('manufacturers.name as mfgname','manufacturers.id as mfgid','cars.*',DB::raw('count(cars.id) as total'))
        ->groupBy('cars.name')->groupBy('cars.manufacturer_id')->where('cars.status',1)->orderBy('manufacturers.name')
        ->get();
        return view('inventory',['cars'=>$cars, 'ccr'=>$ccr]);
    }

    public function sold(Request $request){
        if ($request->ajax())
        {
            // $text = $request->text;
            // dd($text);
            DB::table('cars')->where('id',$request->car_id)->update(['status'=>0]);
            return response()->json(['msg' => $request->car_id, 'success' =>1]);
        }
    }
}
