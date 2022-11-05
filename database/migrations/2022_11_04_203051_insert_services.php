<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('services')->insert(
            array(
                'name' => 'Warranty',
                'deadline' => 30,
                'cost' => 15
            )
        );
        DB::table('services')->insert(
            array(
                'name' => 'Delivery',
                'deadline' => 5,
                'cost' => 25
            )
        );
        DB::table('services')->insert(
            array(
                'name' => 'Warranty',
                'deadline' => 30,
                'cost' => 15
            )
        );
        DB::table('services')->insert(
            array(
                'name' => 'Configure',
                'deadline' => 30,
                'cost' => 50
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
