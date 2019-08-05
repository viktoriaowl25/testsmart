<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            ['title' => 'Создан'],
            ['title' => 'Обработан'],
            ['title' => 'Передан курьеру'],
            ['title' => 'Выполнен'],
            ['title' => 'Отменен'],
        ]);
    }
}
