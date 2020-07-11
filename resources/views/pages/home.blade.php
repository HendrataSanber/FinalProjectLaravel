@extends('layouts.app')

@section('content')
 <div class="d-sm-flex align-items-center justify-content-between m-4">
            <h1 class="h3 mb-0 text-gray-800"> Selamat datang di setak operp;ow</h1>
          </div>
<div class="card shadow m-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DAFTAR PERTANYAAN</h6>
    </div>
<div class="row">  
    </div>
        <div class="col ">
            @forelse ($pertanyaan as $item)
                <div class="card shadow m-4">
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ $item->judul }}</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Dropdown Header:</div>
                        <a class="dropdown-item" href="#">Edit</a>
                        <a class="dropdown-item" href="#">update</a>
                        <div class="dropdown-divider"></div>
                        </div>
                    </div>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body mt-2">
                        <h6 class="mb-4">{{ $item->created_at }}</h6>
                    Dropdown menus can be placed in the card header in order to extend the functionality of a basic card. In this dropdown card example, the Font Awesome vertical ellipsis icon in the card header can be clicked on in order to toggle a dropdown menu.
                   <br>
                    <a href="#" class="btn btn-info btn-icon-split mt-5">
                        <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">{{ $item->tag }}</span>
                    </a>
                    </div>
                    </div>
            </div>
            @empty

            @endforelse
           
           
        </div>
    </div>
</div>
</div>

<!-- Collapsable Card Example -->
        

@endsection