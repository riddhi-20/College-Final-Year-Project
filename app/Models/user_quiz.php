<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class user_quiz extends Model
{
    use HasFactory;

    protected $table = 'user_quiz';
    protected $fillable = ['users_id', 'test_id', 'topics_id', 'question_id', 'correctAns', 'givenAns'];

}
