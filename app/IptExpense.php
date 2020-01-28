<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Balping\HashSlug\HasHashSlug;

class IptExpense extends Model
{
    use HasHashSlug;
    
    protected $table = "ipt_expenses";
    
    protected $guarded = [];
    
    public function project() {
        return $this->belongsTo('App\IptProject');
    }
}
