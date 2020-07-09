@extends('layouts.app')

@section('content')
                <!-- Begin Page Content -->
                <div class="container-fluid">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">Tambah Paket Travel</h1>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <form action="{{route('pertanyaan.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="judul">Judul</label>
                                <input type="text" class="form-control" name="judul" placeholder="Title" value="">
                            </div>
                            <div class="form-group">
                                <label for="tag">tag</label>
                                <input type="text" class="form-control " name="tag" value="">
                            </div>
                            <div class="form-group">
                                <label for="isi">pertanyaan</label>
                                <textarea name="isi"  rows="100"class="ckeditor w-100  form-control" ></textarea>
                            </div>
                           
                            <button type="submit" class="btn btn-primary btn-block">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
    </div>
    
@endsection