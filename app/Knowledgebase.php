<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Kbcategory;

class Knowledgebase extends Model
{
    public $table = "knowledgebases";

    public $timestamps=false;
    //protected $primarykey="knowledgebase_id"

    protected $fillable = [
        "kb_topic", "kb_article", "kb_category"
    ];

    public function kbcategory()
    {
        return $this->belongsTo(Kbcategory::class, 'kb_category');
    }
}
