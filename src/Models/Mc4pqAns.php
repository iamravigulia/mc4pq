<?php
namespace Edgewizz\Mc4pq\Models;

use Illuminate\Database\Eloquent\Model;

class Mc4pqAns extends Model
{
    public function match(){
        return $this->belongsTo('Edgewizz\Mc4pq\Models\mc4pqAns', 'match_id');
    }
    protected $table = 'fmt_mc4pq_ans';
}
