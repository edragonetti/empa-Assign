<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Session extends Model 
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sessions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sessionid','deviceid','userid','elapsed'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}