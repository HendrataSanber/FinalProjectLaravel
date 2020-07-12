@extends('layouts.app')

@section('content')
    <div class="card shadow m-4">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
            <a href="/pertanyaan/{{$pertanyaan[0]->id}}">
                <h6 class="m-0 font-weight-bold text-primary">{{ $pertanyaan[0]->judul }}</h6>
            </a>
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
        <div class="card-body mt-1">
            <div class="row align-self-md-center">
                <div class="col-2  ">
                    
                        
                        <a class="btn btn-info mb-2 mt-1 ml-5" href="/upvotep/{{$pertanyaan[0]->id}}">
                            <i class="fa fa-arrow-alt-circle-up "></i> 
                        </a>
                        <br>
                        <h3 class="text-info ml-4 mt-2 pl-4" > {{$pertanyaan[0]->totalvote}}</h3>
                        <a class="btn btn-info mt-2 ml-5 mb-3" href="/downvotep/{{$pertanyaan[0]->id}}">
                            <i class="fa fa-arrow-alt-circle-down "></i> 
                        </a>
                        <br>
                        <div class=" text-center">
                            
                            <?php if($pertanyaan[0]->currentvote==10){
                            echo '<h6 class="text-success"> User ini sudah upvote</h6>';}
                            else if($pertanyaan[0]->currentvote==-1){
                            echo '<h6 class="text-danger"> User ini sudah downvote</h6> ';
                            }else{
                            echo  '<h6 class="text-warning"> User ini belum vote</h6>';
                            }
                        ?>
                        </div>
                </div>
                <div class="col-10 border-left-info">
                    <h6 class="mb-4">{{ $pertanyaan[0]->created_at }}</h6>
                    <?php echo htmlspecialchars_decode($pertanyaan[0]->isi); ?>
                    <br>
                    <a href="#" class="btn btn-info btn-icon-split mt-5">
                        <span class="icon text-white-50">
                        <i class="fas fa-info-circle"></i>
                        </span>
                        <span class="text">{{ $pertanyaan[0]->tag }}</span>
                    </a>
                </div>
            </div>
        <hr>
        </div>
        
        @foreach($pertanyaan[0]->komentar as $item)
        
        <div class="card shadow ml-3 mr-3 my-1 border-left-info w-50">
            
            
            <blockquote class="blockquote pt-1 pl-3 text-info">&quot;
                {{$item["isi"]}} &quot;
            </blockquote>
            <h6 class="pl-3 pr-3 pt-0 align-self-end">{{$item["time"]}}</h6>
        </div>
        @endforeach

        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapse0" aria-expanded="false" aria-controls="collapseExample">
            Click to add comment
        </button>

        <div class="collapse" id="collapse0">
            <form action="/komentarpertanyaan" method="POST">
            @csrf
            <br>
                <textarea name="isi" style="width:100%" rows=5></textarea>
                <br>
                <input type="hidden" name="id" value={{$pertanyaan[0]->id}}>
                <input type="submit" style="width:100%" class="btn btn-info">
            </form>
        </div>
    </div>
    @foreach($jawaban as $item)
    <div class="card shadow m-4">
        <div class="card-body mt-2">
            <h6 class="mb-4">{{ $item->created_at }}</h6>
            <div class="card" style="height: 20%"><?php echo htmlspecialchars_decode($item->isi); ?>
        </div>
        <div class="row mt-4 ml-2 d-flex">
            <a  class=" btn btn-info" href="/upvotej/{{$item->id}}/{{$pertanyaan[0]->id}}">
                <i class="fas fa-arrow-up"></i>
            </a>
            <h6 class="text-info my-2 mx-4 ">{{$item->totalvote}}</h6>
            <a  class=" btn btn-info" href="/downvotej/{{$item->id}}/{{$pertanyaan[0]->id}}">
            <i class="fas fa-arrow-down"></i>
            </a>
        </div>
           
            <?php
                if($item->currentvote==10){
                    echo '<h6 class="text-success">User ini sudah upvote</h6>';
                }
                else if($item->currentvote==-1){
                    echo '<h6 class="text-danger">User ini sudah downvote</h6>';
                }
                else{
                    echo '<h6 class="text-danger">User ini belum vote</h6>';
                }
            ?>
        <hr>
    </div>
        
        
        @foreach($item->komentar as $item2)
         <div class="card shadow ml-3 mr-3 my-1 border-left-info w-50">
            
            <blockquote class="blockquote pt-1 pl-3 text-info">&quot;
                {{$item2["isi"]}} &quot;
            </blockquote>
            <h6 class="pl-3 pr-3 pt-0 align-self-end">{{$item2["time"]}}</h6>
        </div>
        
        @endforeach
        <button class="btn btn-primary px-3" type="button" data-toggle="collapse" data-target="#collapse{{$item->id}}" aria-expanded="false" aria-controls="collapseExample">
            Click to add comment
        </button>

        <div class="collapse" id="collapse{{$item->id}}">
            <form action="/komentarjawaban" method="POST">
            @csrf
            <br>
                <textarea name="isi" style="width:100%" rows=5></textarea>
                <br>
                <input type="hidden" name="id" value={{$item->id}}>
                <input type="hidden" name="pertanyaan_id" value={{$pertanyaan[0]->id}}>
                <input type="submit" style="width:100%" class="btn btn-info">
            </form>
        </div>
    </div>
    @endforeach
    <div class="container">
    <form action="/jawaban" method="POST">
    @csrf
    <div class="card shadow m-5 p-2">
        <h3>Jawaban baru</h3>
        <textarea class=" ckeditor mx-5"name="isi" placeHolder="Masukkan jawaban baru di sini"></textarea>
        <input type="hidden" name="pertanyaan_id" value="{{$pertanyaan[0]['id']}}">
        <div class="d-block text-center pt-2">        <input  class=" btn btn-success d-flex"type="submit">    
</div>
    </div>
    </form>
    </div>
@endsection