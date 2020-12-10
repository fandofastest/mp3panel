<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;
use App\Models\Album;
use App\Models\Genre;
use App\Models\Artist;
use App\Models\Playlistsong;
use Illuminate\Support\Facades\DB;


class MobileController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $baseapiurl=asset('storage/');

        $song['song'] = Song::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),'songs.plays')
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->orderByDesc('songs.created_at')
        ->get();

        return response()->json($song);

        //
    }


    public function getAllAlbum()
    {

        $baseapiurl=asset('storage/');
        $album['album'] = Album::select('.albums.id as id','year','albums.name as name',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as cover'),'albums.deskripsi as deskripsi','genres.name as genre','artists.name as artist','albums.plays',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'))
        ->join('genres','genres.id','albums.genre_id')
        ->join('artists','artists.id','albums.artist_id')
        ->get();
        $new['album']=[];
        foreach ($album as $data ) {
         
                $data->totalsong=$this->countSongbyalbumid($data->id);
                array_push($new['album'],$data);

            # code...
        }

        // $album=Album::all();
        return response()->json($new);

        //
    }

    public function getAllPlaylist()
    {

        $baseapiurl=asset('storage/');
        $playlist = Playlist::select('id','name',DB::raw('CONCAT("'.$baseapiurl.'/playlist/",cover) as cover'))
        ->where('id', '!=' , 1)
        ->get();
        $new['playlist']=[];
        foreach ($playlist as $data ) {
                $data->totalsong=$this->countSong($data->id);
                array_push($new['playlist'],$data);

            # code...
        }


        // $album=Album::all();
        return response()->json($new);

        //
    }

    public function getAllArtist()
    {
        $baseapiurl=asset('storage/');
        $artist['artist'] = Artist::select('id','name',DB::raw('CONCAT("'.$baseapiurl.'/artist/",cover) as cover'))
        ->get();
        // dd('ssss');
        return response()->json($artist);
        //
    }
    public function getAllGenre()
    {

        $baseapiurl=asset('storage/');
        $genre['genre'] = Genre::select('id','name',DB::raw('CONCAT("'.$baseapiurl.'/genre/",cover) as cover'))
        ->get();

        // $album=Album::all();
        return response()->json($genre);

        //
    }


    public function getSongByTitle(String $title)
    {

        $baseapiurl=asset('storage/');

        $song['song'] = Song::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),'songs.plays')
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->where('songs.title', 'like', "%{$title}%")
        ->orWhere('artists.name', 'like', "%{$title}%")
        ->get();

        return response()->json($song);

        //
    }

    public function getSongById(String $id,String $isLocal)
    {

        $baseapiurl=asset('storage/');

        if ($isLocal=='true') {
            $baseapiurl='';

            # code...
        }

        $song['song'] = Song::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),'songs.plays')
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->where('songs.id',$id)
        ->get();

        return response()->json($song);

        //
    }

    public function getSongByPlaylist(String $playlistid)
    {

        $baseapiurl=asset('storage/');

        

        $song['playlist'] = Playlistsong::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.plays')
        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('playlistsongs.playlist_id',$playlistid)
        ->get();

        

        return response()->json($song);

        //
    }

    public function countSong(String $playlistid){

        $song = Playlistsong::select('*')
        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('playlistsongs.playlist_id',$playlistid)
        ->get();

        return count($song);

    }


    public function countSongbyalbumid(String $id){

        $song = Song::select('*')
        ->join('albums','albums.id','songs.album_id')
        ->where('songs.album_id',$id)
        ->get();

        return count($song);

    }

    public function getTopChart()
    {

        $baseapiurl=asset('storage/');

        $song['song'] = Playlistsong::select('songs.id','albums.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.plays')

        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('playlistsongs.playlist_id',1)
        ->get();

        return response()->json($song);

        //
    }
    public function getSongByGenre(String $genrename)
    {

        $baseapiurl=asset('storage/');

        $song['song'] = Songs::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),'songs.plays')

        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('genres.name',$genrename)
        ->get();

        return response()->json($song);

        //
    }
    public function getSongByAlbum(String $albumid)
    {

        $baseapiurl=asset('storage/');

        $song['song'] = Song::select('songs.id','albums.year',DB::raw('CONCAT("'.url('api/mobile').'/play/",songs.id) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.plays')

        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('albums.id',$albumid)
        ->get();

        return response()->json($song);

        //
    }

    public function playsong(String $idsong){
        $song=Song::where('id',$idsong)->get()->first();
        $song->increment('plays');
        $album=Album::where('id',$song->album_id)->get()->first();
        $album->increment('plays');
         $url= asset('storage/songmp3/')."/".$song->file;  
        

         return redirect($url);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
