<?php
namespace Edgewizz\Mc4pq\Models;

use Illuminate\Database\Eloquent\Model;

class Mc4pqQues extends Model{
    public function answers(){
        return $this->hasMany('Edgewizz\Mc4pq\Models\Mc4pqAns', 'question_id');
    }
    protected $table = 'fmt_mc4pq_ques';
}