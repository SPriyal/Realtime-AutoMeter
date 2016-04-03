<?php namespace App;

use Baum\Node;
class Company extends Node {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     *
     * One company has many departments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

}
