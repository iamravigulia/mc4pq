<?php
namespace Edgewizz\Mc2pq\Models;

use Illuminate\Database\Eloquent\Model;

class Mc2pqQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mc2pq\Models\Mc2pqAns', 'question_id');
    }
    protected $table = 'fmt_mc2pq_ques';
}