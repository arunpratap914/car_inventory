<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $table = 'cars';
    protected $fillable = ['color','mfg','mfg_year','reg_num','note','pic1','pic2'];


    public function manufacturer()
    {
        return $this->belongsTo('App\Manufacturer','manufacturer_id');
    }
}
