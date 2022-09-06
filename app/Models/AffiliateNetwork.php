<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AffiliateNetwork extends Model
{
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
