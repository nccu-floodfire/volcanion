<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
	$this->call(PttSummaryTableSeeder::class);
    $this->call(TwitterSummaryTableSeeder::class);
    $this->call(NewsSummaryTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
    }
}
