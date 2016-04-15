<?php
/**
 * Created by PhpStorm.
 * User: NIKHIL
 * Date: 09-04-2016
 * Time: 09:58 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model as Eloquent;

class parameterDetails extends Eloquent{
    protected $table ='parameter_details';

//    public function dataDetails(){
//        return $this->hasOne('App\Data','parameter_id');
//    }
} 