<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VotePertanyaan;
use App\VoteJawaban;

class VoteController extends Controller
{
    public function uppertanyaan($id)
    {
        $match=['pertanyaan_id'=>$id,'user_id'=>1000000];
        $vote=VotePertanyaan::updateOrCreate($match,['count'=>'10']);
        return redirect('pertanyaan/'.$id);
    }
    
    public function downpertanyaan($id)
    {
        $match=['pertanyaan_id'=>$id,'user_id'=>1000000];
        $vote=VotePertanyaan::updateOrCreate($match,['count'=>'-1']);
        return redirect('pertanyaan/'.$id);
    }
    
    public function upjawaban($id,$pid)
    {
        $match=['jawaban_id'=>$id,'user_id'=>1000000];
        $vote=VoteJawaban::updateOrCreate($match,['count'=>'10']);
        return redirect('pertanyaan/'.$pid);
    }
    
    public function downjawaban($id,$pid)
    {
        $match=['jawaban_id'=>$id,'user_id'=>1000000];
        $vote=VoteJawaban::updateOrCreate($match,['count'=>'-1']);
        return redirect('pertanyaan/'.$pid);
    }
}
