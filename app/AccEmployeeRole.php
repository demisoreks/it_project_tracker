<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccEmployeeRole extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_employee_roles";
    
    protected $guarded = [];
    
    public function employee() {
        return $this->belongsTo('App\AccEmployee');
    }
    
    public function role() {
        return $this->belongsTo('App\AccRole');
    }
}
