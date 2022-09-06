<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lander extends Model
{
    public function workspace()
    {
        return $this->belongsTo(Workspace::class);
    }
}
