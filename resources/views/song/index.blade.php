@extends('layouts.app')

@section('content')
    @include('layouts.headers.cards')
    
    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col-xl-12 mb-5 mb-xl-0">
                <div class="card bg-gradient-default shadow">
                    <div class="card-header bg-transparent">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="text-uppercase text-light ls-1 mb-1">Overview</h6>
                                <h2 class="text-white mb-0">List Song</h2>
                            </div>
                            <div class="col">
                                <ul class="nav nav-pills justify-content-end">
                                    <li class="nav-item mr-2 mr-md-0" data-toggle="chart"  >
                                        <a type="button" href="#" class="nav-link py-2 px-3 active"  data-toggle="modal" data-target="#modaladdalbum">
                                            <span class="d-none d-md-block">Add Song</span>
                                            
                                        </a>
                                    </li>
                                 
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <!-- Chart -->
                       
                            <!-- Chart wrapper -->
                            <div class="table-responsive">
    














                                <div>
                                    <table class="table align-items-center table-dark">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col" class="sort" data-sort="name">No</th>
                                                <th scope="col" class="sort" data-sort="budget">Title</th>
                                                <th scope="col" class="sort" data-sort="budget">Duration</th>
                                                <th scope="col" class="sort" data-sort="budget">Album Name</th>
                                                <th scope="col" class="sort" data-sort="budget">Artist Name</th>
                                                <th scope="col" class="sort" data-sort="budget">Genre Name</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody class="list">
                                            @foreach ($song as $item)
                                                
                                           

                                            <tr>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                   
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['id']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                   
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['songname']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                   
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['duration']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                        <a href="#" class="avatar rounded-circle mr-3">
                                                          
                                                            
                                                        <img alt="Image placeholder" src="{{ asset('storage/album/'.$item['albumcover'])}}">
                                                            
                                                          
                                                        </a>
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['albumname']}}</span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                        <a href="#" class="avatar rounded-circle mr-3">
                                                          
                                                            
                                                        <img alt="Image placeholder" src="{{ asset('storage/artist/'.$item['artistcover'])}}">
                                                            
                                                          
                                                        </a>
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['artistname']}}</span>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td scope="row">
                                                    <div class="media align-items-center">
                                                        
                                                        <a href="#" class="avatar rounded-circle mr-3">
                                                          
                                                            
                                                        <img alt="Image placeholder" src="{{ asset('storage/genre/'.$item['genrecover'])}}">
                                                            
                                                          
                                                        </a>
                                                        <div class="media-body">
                                                        <span class="name mb-0 text-sm">{{$item['genrename']}}</span>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                
                                            
                                                <td class="text-right">
                                                    
                                                    <form action="{{ route('song.destroy',$item->id) }}" method="POST">
   
                                                        <a class="btn btn-info"  id="modalshow">Play</a>
                                                    <input hidden  id="iddata" value="{{$item->id}}"/>
                                        
                                                        {{-- <a class="btn btn-primary" href="{{ route('artist.edit',$item->id) }}">Edit</a> --}}
                                       
                                                        @csrf
                                                        @method('DELETE')
                                          
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                            @endforeach
                                            
                                            
                                           
                                            
                                           
                                            
                                        </tbody>
                                    </table>
                                </div>
                                
                                </div>
                           
                    </div>
                </div>
            </div>
   
        </div>
        <div class="row mt-5">
            <div class="col-xl-8 mb-5 mb-xl-0">
                
            </div>
            <div class="col-xl-4">
                
            </div>
        </div>

        <!-- Modal -->
                <div class="modal fade" id="modaladdalbum" tabindex="-1" role="dialog" aria-labelledby="modaladdalbum" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modaladdalbum">Add New Song</h5>
                       

                        

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                     
                        <form method="POST" action="{{ route('song.store') }}" enctype="multipart/form-data" >
                            @csrf

                            
                            <div class="form-group">
                             <input class="form-control" name="name" type="text" placeholder="Song Title" id="example-text-input" required>
                            </div>

                                 <div class="form-group">
                                <select  class="form-control" name="artist" id="artist"  required >
                                  <option>Pilih Artist</option>
                                  @foreach ($artist as $item)
                                <option value="{{$item->id}}">{{$item->name}}</option>
                                  @endforeach
                            
                                </select>
                              </div>   

                              <div class="form-group">
                                <select  class="form-control" name="album" id="album" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required >
                                  <option>Pilih Album</option>
                                  
                            
                                </select>
                              </div>   

                              <div class="form-group">
                                <select  class="form-control" name="genre" id="genre" data-toggle="select" title="Simple select" data-live-search="true" data-live-search-placeholder="Search ..." required >
                                  <option>Pilih Genre</option>
                                  
                            
                                </select>
                              </div>   


                              <div class="custom-file">
                                <input name="image" type="file" class="custom-file-input" id="selectcover" lang="en" required>
                                <label class="custom-file-label" id="labelcover" for="customFileLang">Select Cover</label>
                            </div>

                            <div class="custom-file">
                                <input name="mp3" type="file" class="custom-file-input" id="selectsong" lang="en" required>
                                <label class="custom-file-label" id="labelsong" for="customFileLang">Select Song</label>
                            </div>
                              

                            <div class="custom-file">
                                <input name="lirik" type="file" class="custom-file-input" id="selectlyric" lang="en" required>
                                <label class="custom-file-label" id="labellyric" for="customFileLang">Select Lyric</label>
                            </div>
                            
                       
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                    </div>
                    </div>
                    
                </div>
                </div>

                <!-- Modal -->
                <div class="modal fade" id="modalplay" role="dialog">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                        <h5 class="modal-title" id="titlemodal">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        </div>
                        <div class="modal-body">
                          
                            <p id="artist" class="card-text">Artist</p>
                            <p id="album" class="card-text">album</p>
                            <p id="genre" class="card-text">genre</p>

                            <audio id="player" controls="controls">
                                <source id="mp3_src" src="" type="audio/mp3" />
                                Your browser does not support the audio element.
                          </audio>
                              
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        
                        </div>
                    </div>
                    </div>
                </div>


        @include('layouts.footers.auth')
    </div>


   
@endsection

@push('js')
<script>

$('#modalshow').click(function(e){
    var dataid = $("#iddata").val();
    $('#modalplay').modal();
    


        $.ajax({
            url:'/api/song/'+dataid,
            type:'GET',
            dataType: 'json',
            success:function(data) {
                var title = data['data'][0].songname;
                var artist = data['data'][0].artistname;
                var album = data['data'][0].albumname;
                var genre = data['data'][0].genrename;
                var sourceUrl =  data['data'][0].filemp3;
                var srcmp3 = "{{ asset('storage/songmp3/')}}"+'/'+sourceUrl;

                // console.log(genre);

                $('#titlemodal').text(title);
                $('p#artist').text(artist);
                $('p#album').text(album);
                $('p#genre').text(genre);

                var audio = $("#player");      
                $("#mp3_src").attr("src", srcmp3);
                /****************/
                audio[0].pause();
                audio[0].load();

                audio[0].oncanplaythrough = audio[0].play();

                        

       
            },
        });
    });










    $(function(){
        $('#selectcover').change(function(e){
            var fileName = e.target.files[0].name;
            $("#labelcover").empty();
            $("#labelcover").append(fileName);
        });
        $('#selectsong').change(function(e){
           

            var fileName = e.target.files[0].name;
            $("#labelsong").empty();
            $("#labelsong").append(fileName);
        });
        $('#selectlyric').change(function(e){
            var fileName = e.target.files[0].name;
            $("#labellyric").empty();
            $("#labellyric").append(fileName);
        });


        $( "#album" ).change(function() {
    
    var data = $(this).val();


    $('#genre').find('option').not(':first').remove();
   $.ajax({
           url: "{{ url('api/album/') }}/"+data ?? '',
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var genreid = response['data'][i].genreid;
                 var genrename = response['data'][i].genrename;

                  if(i==0){
                    var option = "<option selected value='"+genreid+"'>"+genrename+"</option>";

                  }  
                  else {
                    var option = "<option value='"+genreid+"'>"+genrename+"</option>";

                  }

                 $("#genre").append(option);
               }
             }

           }
        });
    });


        
     

$( "#artist" ).change(function() {
    
    var data = $(this).val();


    $('#album').find('option').not(':first').remove();
    $('#genre').find('option').not(':first').remove();
   $.ajax({
           url: "{{ url('api/artist/') }}/"+data ?? '',
           type: 'get',
           dataType: 'json',
           success: function(response){

             var len = 0;
             if(response['data'] != null){
               len = response['data'].length;
             }

             if(len > 0){
               // Read data and create <option >
               for(var i=0; i<len; i++){

                 var albumid = response['data'][i].albumid;
                 var albumname = response['data'][i].albumname;

                 var genreid = response['data'][i].genreid;
                 var genrename = response['data'][i].genrename;

                  if(i==0){
                    var option = "<option selected value='"+albumid+"'>"+albumname+"</option>";
                    var optiongenre = "<option selected value='"+genreid+"'>"+genrename+"</option>";

                  }  
                  else {
                    var option = "<option value='"+albumid+"'>"+albumname+"</option>";

                    var optiongenre = "<option value='"+genreid+"'>"+genrename+"</option>";

                  }


                 $("#album").append(option);
                 $("#genre").append(optiongenre);
               }
             }

           }
        });
    });

});    
</script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush