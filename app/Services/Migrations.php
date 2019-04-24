<?php

namespace App\Services;

use DB;
use Illuminate\Database\Schema\Blueprint;

class Migrations
{
    public static function timestamps(Blueprint $table)
    {
        $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        $table->timestamp('created_at')->useCurrent();
    }
}
