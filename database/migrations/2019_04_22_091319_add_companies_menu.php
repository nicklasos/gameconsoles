<?php

use App\Admin\Services\Menu;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCompaniesMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        app(Menu::class)
            ->order(1)
            ->title('Companies')
            ->icon('fa-building')
            ->uri('companies')
            ->create();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        app(Menu::class)->drop('Companies');
    }
}
