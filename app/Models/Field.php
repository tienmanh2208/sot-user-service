<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Field extends Model
{
    protected $table = 'fields';

    protected $fillable = ['name', 'question_count'];

    public function getTopField()
    {
        $numberOfField = 5;

        return $this->orderBy('question_count', 'DESC')->limit($numberOfField)->get();
    }
}
