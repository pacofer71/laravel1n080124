<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias=[
            'Informatica'=>'Categoria Relacionada con el mundo de la informatica',
            'Cine'=>'Categoria Relacionada con el mundo del cine',
            'Deporte'=>'Categoria Relacionada con el mundo del deporte',
            'Comida'=>'Categoria Relacionada con el mundo de la comida',
        ];
        foreach($categorias as $nombre=>$descripcion){
            Category::create([
                'nombre'=>$nombre,
                'descripcion'=>$descripcion
            ]);
        }
    }
}
