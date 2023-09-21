<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class questions extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'questions';
    protected $fillable = ['topics_id', 'question', 'optionA', 'optionB', 'optionC', 'optionD', 'correctAns','is_img', 'quesimg', 'optAimg', 'optBimg','optCimg','optDimg'];

    public function gettopics(){
        return $this->hasOne('App\Models\questions', 'id', 'topics_id');
    }

    public function getquestions(){
        return $this->hasOne('App\Models\courses', 'topics_id', 'id');
    }

    protected $dates = ['deleted_at'];
}
