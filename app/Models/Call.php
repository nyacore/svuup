<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Call extends Model
{
    
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'lead_id',
        'file_name',
    ];

    protected $table = 'calls';

}