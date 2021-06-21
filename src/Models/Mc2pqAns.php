<?php
namespace Edgewizz\Mc2pq\Models;

use Illuminate\Database\Eloquent\Model;

class Mc2pqAns extends Model
{
    public function match(){
        return $this->belongsTo('Edgewizz\Mc2pq\Models\mc2pqAns', 'match_id');
    }
    protected $table = 'fmt_mc2pq_ans';
}
