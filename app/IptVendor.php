<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class IptVendor extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_vendors";
    
    protected $guarded = [];
    
    public function projects() {
        return $this->hasMany('App\IptProject');
    }
}
