<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Permettere il mass assignment per le colonne 'title', 'content', 'type_id', 'slug'
    protected $fillable = ['title', 'content', 'type_id', 'slug'];

    // Definire la relazione many-to-one con Type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
