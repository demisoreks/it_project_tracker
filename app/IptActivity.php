<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class IptActivity extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_activities";
    
    protected $guarded = [];
    
    public function employee() {
        return $this->belongsTo('App\AccEmployee');
    }
}
