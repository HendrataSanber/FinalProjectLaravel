    @extends('layouts.app')

    @section('content')
    <div class="d-sm-flex align-items-center justify-content-between m-4">
                <h1 class="h3 mb-0 text-gray-800"></h1>
                <a href="{{ route('pertanyaan.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> Buat Pertanyaan</a>
    </div>
    <div class="card shadow m-2">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DAFTAR PERTANYAAN</h6>
        </div>
        <div class="card-body">
            @foreach ($pertanyaan as $item)
              <div class="card shadow mb-4">
                <div class="card-header bg-info py-2 d-flex flex-row align-items-center justify-content-between">
                  <a href="/pertanyaan/{{$item->id}}">
                  <h6 class=" m-0 font-weight-bold text-white ">{{ $item->judul }}</h6>
                  </a>
                  <div class="dropdown no-arrow">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                      <div class="dropdown-header">Dropdown Header:</div>
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                     <h6 class="mb-4">{{ $item->created_at }}</h6>
                        <h6>{{ $item->isi }}</h6>
                                         <br>
                        @foreach ($item["tag"] as $tag)
                        <a href="#" class="btn btn-info btn-icon-split mt-5">
                            <span class="icon text-white-50">
                            <i class="fas fa-info-circle"></i>
                            </span>
                                <span class="text">{{ $tag }}</span>
                        </a>
                        @endforeach
                </div>
                <form action="/pertanyaan/{{ $item->id}}/edit" method="GET">
                  @csrf
                  <button type="submit" class="btn btn-success">Edit</button>
                  </form>
                <form action="/pertanyaan/{{ $item->id}}" method="POST">
                  @csrf
                  @method("DELETE")
                  <button type="submit" class="btn btn-danger" onclick="
                  var yakin = confirm('Apakah kamu yakin akan menghapus pertanyaan ini?');
                  if (yakin) {
                      
                  }
                  else{
                    return false;
                  }
                  ">Delete</button>
                  </form>
              </div>
            @endforeach
        </div>
    </div>
    

    <!-- Collapsable Card Example -->
            

    @endsection