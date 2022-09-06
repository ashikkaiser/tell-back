<?php

use App\Models\Column;


if (!function_exists('app_path')) {
    /**
     * Get the path to the application folder.
     *
     * @param  string $path
     * @return string
     */
    function app_path($path = '')
    {
        return app('path') . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}

function loadColumns($user_id)
{
    $files = json_decode(file_get_contents(__DIR__ . "/column.json"));
    foreach ($files as $file) {
        foreach ($file->columns as $column) {
            $col = new Column();
            $col->column_for = $file->column_for;
            $col->user_id = $user_id;
            $col->name = $column->name;
            $col->column = $column->column;
            $col->seq = $column->seq;
            $col->tooltip = $column->toltip;
            $col->visibilty = true;
            $col->width = $column->width;
            $col->save();
        }
    }
}
