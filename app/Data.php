<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Data extends Model {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'data';

//    public function paraDetails(){
//        return $this->hasOne('App\parameterDetails','id');
//    }

}
