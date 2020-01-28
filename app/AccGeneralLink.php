<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Balping\HashSlug\HasHashSlug;

class AccGeneralLink extends Model
{
    use HasHashSlug;
    
    protected $table = "acc_general_links";
    
    protected $guarded = [];
}
