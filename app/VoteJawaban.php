<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VoteJawaban extends Model
{
    protected $table="vote_jawaban";
    protected $fillable=["count","jawaban_id","user_id"];
}
