<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class IptComponent extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_components";
    
    protected $guarded = [];
    
    public function project() {
        return $this->belongsTo('App\IptProject');
    }
}
