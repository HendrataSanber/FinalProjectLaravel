<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VotePertanyaan extends Model
{
    protected $table="vote_pertanyaan";
    protected $fillable=["count","pertanyaan_id","user_id"];
}
