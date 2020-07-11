<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use App\Pertanyaan;
use App\KomentarPertanyaan;
use App\Jawaban;
use App\KomentarJawaban;
use App\Tag;

class pertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pertanyaan=Pertanyaan::join('pertanyaan_tag','pertanyaan.id','=','pertanyaan_tag.pertanyaan_id')
            ->join('tag','pertanyaan_tag.tag_id','=','tag.id')
            ->select('pertanyaan.*','tag.tag')->get();
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
            "user_id"=>1000000,//dummy
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
            ->select('pertanyaan.*','tag.tag')->get();
        $jawaban=Jawaban::select('*')
            ->where('pertanyaan_id','=',$id)
            ->get();
        foreach($jawaban as $key=>$item){
            $jid=$item["id"];
            $kompj=KomentarJawaban::select('*')
            ->where('jawaban_id','=',$jid)
            ->get();
        }
        $komp=KomentarPertanyaan::where('pertanyaan_id','=',$id)
            ->select('*')->get();
        return view('pages.show',compact('pertanyaan','jawaban','komp'));
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
