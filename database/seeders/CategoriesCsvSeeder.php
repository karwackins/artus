<?php
namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use JeroenZwart\CsvSeeder\CsvSeeder;

class CategoriesCsvSeeder extends CsvSeeder
{
    public function __construct()
    {
        $this->file = '/database/seeders/csv/categories.csv';
        $this->tablename = 'categories';
        $this->delimiter =  ',';
        $this->timestamps = false;
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::disableQueryLog();
        parent::run();
    }
}
