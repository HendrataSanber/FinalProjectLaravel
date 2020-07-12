<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VotePertanyaan;
use App\VoteJawaban;
use App\Pertanyaan;
use App\Jawaban;
use App\User;
use Auth;

class VoteController extends Controller
{
    public function uppertanyaan($id)
    {
        $match=['pertanyaan_id'=>$id,'user_id'=>Auth::Id()];
        $vote=VotePertanyaan::updateOrCreate($match,['count'=>'10']);

        $userid=Pertanyaan::where('id','=',$id)
            ->select('user_id')
            ->first()["user_id"];
        $reputasipertanyaan=VotePertanyaan::where('user_id','=',$userid)
            ->sum('count');
        $reputasijawaban=VoteJawaban::where('user_id','=',$userid)
            ->sum('count');
        $totalreputasi=$reputasipertanyaan+$reputasijawaban;
        $rep=User::where('id','=',$userid)
            ->update(['reputasi'=>$totalreputasi]);

        return redirect('pertanyaan/'.$id);
    }
    
    public function downpertanyaan($id)
    {
        //check apakah reputasi sudah 15
        $userid=Pertanyaan::where('id','=',$id)
            ->select('user_id')
            ->first()["user_id"];
        $rep=User::where('id','=',$userid)
            ->select('reputasi')
            ->first()['reputasi'];
        if($rep>=15){
            $match=['pertanyaan_id'=>$id,'user_id'=>Auth::Id()];
            $vote=VotePertanyaan::updateOrCreate($match,['count'=>'-1']);
    
            $userid=Pertanyaan::where('id','=',$id)
                ->select('user_id')
                ->first()["user_id"];
            $reputasipertanyaan=VotePertanyaan::where('user_id','=',$userid)
                ->sum('count');
            $reputasijawaban=VoteJawaban::where('user_id','=',$userid)
                ->sum('count');
            $totalreputasi=$reputasipertanyaan+$reputasijawaban;
            $rep=User::where('id','=',$userid)
                ->update(['reputasi'=>$totalreputasi]);
        }

        return redirect('pertanyaan/'.$id);
    }
    
    public function upjawaban($id,$pid)//id = id jawaban, pid = id pertanyaan
    {
        $match=['jawaban_id'=>$id,'user_id'=>Auth::Id()];
        $vote=VoteJawaban::updateOrCreate($match,['count'=>'10']);

        $userid=Jawaban::where('id','=',$id)
            ->select('user_id')
            ->first()["user_id"];
        $reputasipertanyaan=VotePertanyaan::where('user_id','=',$userid)
            ->sum('count');
        $reputasijawaban=VoteJawaban::where('user_id','=',$userid)
            ->sum('count');
        $totalreputasi=$reputasipertanyaan+$reputasijawaban;
        $rep=User::where('id','=',$userid)
            ->update(['reputasi'=>$totalreputasi]);
        return redirect('pertanyaan/'.$pid);
    }
    
    public function downjawaban($id,$pid)
    {
        $userid=Pertanyaan::where('id','=',$id)
            ->select('user_id')
            ->first()["user_id"];
        $rep=User::where('id','=',$userid)
            ->select('reputasi')
            ->first()['reputasi'];
        if($rep>=15){
            $match=['jawaban_id'=>$id,'user_id'=>Auth::Id()];
            $vote=VoteJawaban::updateOrCreate($match,['count'=>'-1']);
    
            $userid=Pertanyaan::where('id','=',$id)
                ->select('user_id')
                ->first()["user_id"];
            $reputasipertanyaan=VotePertanyaan::where('user_id','=',$userid)
                ->sum('count');
            $reputasijawaban=VoteJawaban::where('user_id','=',$userid)
                ->sum('count');
            $totalreputasi=$reputasipertanyaan+$reputasijawaban;
            $rep=User::where('id','=',$userid)
                ->update(['reputasi'=>$totalreputasi]);
        }

        return redirect('pertanyaan/'.$pid);
    }
}
