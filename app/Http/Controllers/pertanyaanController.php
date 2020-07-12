<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Pertanyaan;
use App\KomentarPertanyaan;
use App\Jawaban;
use App\KomentarJawaban;
use App\Tag;
use App\VotePertanyaan;
use App\VoteJawaban;
use Auth;

class pertanyaanController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        /*
        $pertanyaan=Pertanyaan::join('pertanyaan_tag','pertanyaan.id','=','pertanyaan_tag.pertanyaan_id')
            ->join('tag','pertanyaan_tag.tag_id','=','tag.id')
            ->select('pertanyaan.*','tag.tag')->get();
        */
        $pertanyaan=Pertanyaan::select('*')->get();
        foreach($pertanyaan as $item){
            $id=$item["id"];
                $tag=Pertanyaan::join('pertanyaan_tag','pertanyaan.id','=','pertanyaan_tag.pertanyaan_id')
                ->join('tag','pertanyaan_tag.tag_id','=','tag.id')
                ->where('pertanyaan.id','=',$item->id)
                ->select('tag.tag')->get();
            $taglist=array();
            foreach($tag as $tag2){
                array_push($taglist,$tag2->tag);
            }
            $item["tag"]=$taglist;
        }
        return view('pages/pertanyaan',compact('pertanyaan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.buatPertanyaan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*
        $new_pertanyaan=new Pertanyaan;
        $new_pertanyaan->judul=$request["judul"];
        $new_pertanyaan->isi=$request["isi"];
        $new_pertanyaan->user_id=1000000;//dummy
        $new_pertanyaan->save();
        dd($new_pertanyaan);
        */
        $request->validate([
            'judul' => 'required',
            'isi' => 'required',
            'tag'=>'required' 
        ]);
        $new_pertanyaan=Pertanyaan::create([
            "judul"=>$request["judul"],
            "isi"=>$request["isi"],
            "user_id"=>Auth::Id(),//dummy
        ]);
        $tagarray=explode(',',$request["tag"]);
        $tagsmulti=[];
        foreach($tagarray as $strtag){
            $tagassc["tag"]=$strtag;
            $tagsmulti[]=$tagassc;
        }
        foreach($tagsmulti as $tagcheck){
            $tag=Tag::firstOrCreate($tagcheck);
            $new_pertanyaan->tags()->attach($tag->id);
        }

        return redirect('pertanyaan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan=Pertanyaan::join('pertanyaan_tag','pertanyaan.id','=','pertanyaan_tag.pertanyaan_id')
            ->join('tag','pertanyaan_tag.tag_id','=','tag.id')
            ->where('pertanyaan.id','=',$id)
            ->select('pertanyaan.*','tag.tag')
            ->limit(1)
            ->get();
        $komp=KomentarPertanyaan::where('pertanyaan_id','=',$id)
            ->select('*')->get();
        $komentar=array();
        foreach($komp as $item){
            array_push($komentar,["isi"=>$item->isi,"time"=>$item->updated_at]);
        }
        $pertanyaan[0]["komentar"]=$komentar;
        $totalvote=VotePertanyaan::where('pertanyaan_id','=',$id)
            ->sum('count');
        $pertanyaan[0]["totalvote"]=$totalvote;
        $currentvote=VotePertanyaan::where(['pertanyaan_id'=>$id,'user_id'=>Auth::Id()])
        ->select('count')->get();
        if(isset($currentvote[0])){
            $pertanyaan[0]["currentvote"]=$currentvote[0]["count"];
        }
        else{
            $pertanyaan[0]["currentvote"]=0;
        }

        $jawaban=Jawaban::select('*')
            ->where('pertanyaan_id','=',$id)
            ->get();
        foreach($jawaban as $item){
            $jid=$item["id"];
            $komj=KomentarJawaban::select('*')
            ->where('jawaban_id','=',$jid)
            ->get();
            //kumpulkan jadi 1 dlm bntk array
            $komentar=array();
            foreach($komj as $item2){
                array_push($komentar,["isi"=>$item2->isi,"time"=>$item2->updated_at]);
            }
            $item["komentar"]=$komentar;
            $totalvote=VoteJawaban::where('jawaban_id','=',$item->id)
            ->sum('count');
            $item["totalvote"]=$totalvote;
            $currentvote=VoteJawaban::where(['jawaban_id' => $item->id,'user_id'=>Auth::Id()])
            ->select('count')->get();
            if(isset($currentvote[0])){
                $item["currentvote"]=$currentvote[0]["count"];
            }
            else{
                $item["currentvote"]=0;
            }
        }
        return view('pages.show',compact('pertanyaan','jawaban'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
