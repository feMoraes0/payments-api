<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::table("categories")->insert([
      "label" => "Food"
    ]);
    
    DB::table("categories")->insert([
      "label" => "Transport"
    ]);
    
    DB::table("categories")->insert([
      "label" => "Travel"
    ]);
    
    DB::table("categories")->insert([
      "label" => "Bill"
    ]);
    
    DB::table("categories")->insert([
      "label" => "Market"
    ]);

    DB::table("categories")->insert([
      "label" => "Other"
    ]);
  }
}
