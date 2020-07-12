@extends('layouts.app')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"></h1>
                </div>
                @if($errors->any())
                <div class="div alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="card shadow">
                    <div class="card-body">
                        <form action="/pertanyaan/{{$pertanyaan->id}}" method="post">
                            @csrf
                            @method("PUT")
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Title" value="{{$pertanyaan->judul}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="tag">tag</label>
                                <input type="text" class="form-control " name="tag" value="{{$pertanyaan->tag}}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="isi">pertanyaan</label>
                                <textarea name="isi"  rows="100"class="ckeditor w-100  form-control" >{{$pertanyaan->isi}}</textarea>
                            </div>
                           
                            <button type="submit" class="btn btn-primary btn-block">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
    </div>
    
@endsection