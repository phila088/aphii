<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TrashController
{
    public function index(): View
    {
        $tables = DB::select('SHOW TABLES');
        $trashed = [];
        foreach ($tables as $table) {
            $tableName = $table->{'Tables_in_' . env('DB_DATABASE')};
            if (Schema::hasColumn($tableName, 'deleted_at')) {
                $trashed[$tableName] = DB::table($tableName)->whereNotNull('deleted_at')->get();
            }
        }

        return view('admin.trash.index', ['trashed' => $trashed]);
    }
}
