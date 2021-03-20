<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $clients = ['islam','hazem'];

      foreach( $clients as $client){

        \App\Client::create([

          'name' => $client,
          'phone'=>'012345',
          'address'=>'mahalla',
        ]);
        
      }//end of foreach
    }//end of run
}//end of seeder
