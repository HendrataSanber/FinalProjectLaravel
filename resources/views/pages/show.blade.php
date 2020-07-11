@extends('layouts.app')

@section('content')
    <h1>Layout pertanyaan disini:</h1><br>
    <?php
        print_r($pertanyaan);
    ?>    
    <h1>Jawaban yg sudah disubmit sebelumnya disini:</h1><br>
    <?php
        print_r($jawaban);
    ?>    
    <h1>Form kosong untuk jawaban baru disini:</h1><br>
    <form action="/jawaban" method="POST">
    @csrf
        <textarea name="isi" placeHolder="isi disini"></textarea>
        <br>
        <input type="hidden" name="pertanyaan_id" value="{{$pertanyaan[0]['id']}}">
        <input type="submit">
    </form>
@endsection