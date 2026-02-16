<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    
    public function normal_function(){
        return 'funzione normale';
    }

    public static function static_function(){
        return 'funzione statica';
    }
}
