<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    //campos que vamos a poder rellenear, modificar, borrar... desde forms
    protected $fillable=['nombre', 'descripcion'];

    //Ponemos la relacion 1:n con posts
    public function posts(): HasMany{
        return $this->hasMany(Post::class);
    }

    //Metodo estatico para devolver nombre y id de categoria para los selects
    public static function rellenarSelectsCategorias(){
        return Category::select('id', 'nombre')->orderBy('nombre')->get();
    }
}
