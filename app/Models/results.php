<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class results extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $fillable = ['users_id', 'test_id', 'topics_id', 'total_ques', 'total_corr_ans', 'total_skip', 'total_opt_count'];

}
