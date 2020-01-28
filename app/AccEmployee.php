<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccEmployee extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_employees";
    
    protected $guarded = [];
    
    public function activities() {
        return $this->hasMany('App\IptActivity');
    }
    
    public function employeeRoles() {
        return $this->hasMany('App\AccEmployeeRole');
    }
    
    public function updates() {
        return $this->hasMany('App\IptUpdate');
    }
}
