<?php

use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('clients')->delete();
        \DB::table('clients')->insert(array (
            0 =>
            array (
                'id' => 1,
                'username'   => 'ramibadran',
                'password'   => 'test123',
                'status'     => '1', 
                'deleted_at' => NULL,
                'updated_at' => NULL,
                'created_at' => NULL,
            ),
        ));


    }
}
