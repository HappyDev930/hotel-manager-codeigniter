<?php

namespace App\model;

use Illuminate\Database\Eloquent\Model;

class Topdealshotel extends Model
{
    /**
     * Added just to demonstrate that models work
     * @return String
     */
   protected $table = 'topdealshotel';
   protected $primaryKey = 'id';
   //protected $fillable   = ['title', 'first_name', 'last_name', 'mobile_no', 'address', 'pin_code'];
   protected $guarded   = ['id'];
}
