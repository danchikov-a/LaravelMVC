<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class () extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('services')->insert(
            [
                'name' => 'Warranty',
                'deadline' => 30,
                'cost' => 15,
            ]
        );
        DB::table('services')->insert(
            [
                'name' => 'Delivery',
                'deadline' => 5,
                'cost' => 25,
            ]
        );
        DB::table('services')->insert(
            [
                'name' => 'Install',
                'deadline' => 15,
                'cost' => 15,
            ]
        );
        DB::table('services')->insert(
            [
                'name' => 'Configure',
                'deadline' => 30,
                'cost' => 50,
            ]
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
