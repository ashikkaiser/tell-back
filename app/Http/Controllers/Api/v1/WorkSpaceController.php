<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Workspace;
use Illuminate\Http\Request;

class WorkSpaceController extends Controller
{
    public function workspaces()
    {
        $workSpace =  Workspace::where('user_id', auth()->user()->id)->get();
        return $workSpace;
        return response()->json(['data' => $workSpace]);
    }
}
