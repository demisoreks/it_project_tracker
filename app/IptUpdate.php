<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class IptUpdate extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_updates";
    
    protected $guarded = [];
    
    public function project() {
        return $this->belongsTo('App\IptProject');
    }
    
    public function employee() {
        return $this->belongsTo('App\AccEmployee');
    }
}
