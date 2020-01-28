<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class IptProject extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_projects";
    
    protected $guarded = [];
    
    public function vendor() {
        return $this->belongsTo('App\IptVendor');
    }
    
    public function components() {
        return $this->hasMany('App\IptComponent');
    }
    
    public function expenses() {
        return $this->hasMany('App\IptExpense');
    }
    
    public function updates() {
        return $this->hasMany('App\IptUpdate');
    }
}
