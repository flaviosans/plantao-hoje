<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produtos')->insert([
            ['nome' => 'cal', 'medida_id'=> 4],
            ['nome' => 'areia', 'medida_id' => 2],
            ['nome' => 'tijolo', 'medida_id' => 3],
            ['nome' => 'telha', 'medida_id' => 3],
            ['nome' => 'pedra', 'medida_id' => 2]
        ]);


        DB::table('users')->insert([
            ['name' => 'Flavio', 'email' => 'flavio@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra'],
            ['name' => 'Empresa', 'email' => 'empresa@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra'],
            ['name' => 'Outra', 'email' => 'outra@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra'],
            ['name' => 'terceira', 'email' => 'terceira@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra'],
            ['name' => 'Quarta empresa', 'email' => 'quarta@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra'],
            ['name' => 'Atrasada', 'email' => 'atrasada@a.com', 'password' => '$2y$10$inFZ8y.E38YuZxkdo2RqOuLVBJdj0LevoQfYxSpvPahe3HRwg7mra']
        ]);
    }
}
