<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class courses extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cat_topic';
    protected $fillable = ['category_id', 'topic_name'];

    public function getcategory(){
        return $this->hasOne('App\Models\category', 'id', 'category_id');
    }

    public function getquestions(){
        return $this->hasMany('App\Models\questions', 'id', 'topics_id');
    }

    protected $dates = ['deleted_at'];
}
