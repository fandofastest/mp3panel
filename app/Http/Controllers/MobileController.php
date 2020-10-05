<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Song;
use App\Models\Playlist;
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

        $song['data'] = Song::select('songs.id',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->get();

        // if (!is_null($title)) {
        //     $song->where('songs.title',$title);
        //     # code...
        // }
       
       
 
        return response()->json($song);

        //
    }

    public function getSongByTitle(String $title)
    {   

        $baseapiurl=asset('storage/');

        $song['data'] = Song::select('songs.id',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->where('songs.title',$title)
        ->get();      
 
        return response()->json($song);

        //
    }
    
    public function getSongByPlaylist(String $playlistid)
    {   

        $baseapiurl=asset('storage/');

        $song['data'] = Playlistsong::select('songs.id',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))

        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('playlistsongs.playlist_id',$playlistid)
        ->get();      
 
        return response()->json($song);

        //
    }

    public function getSongByGenre(String $genrename)
    {   

        $baseapiurl=asset('storage/');

        $song['data'] = Playlistsong::select('songs.id',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))

        ->join('songs','songs.id','playlistsongs.song_id')
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

        $song['data'] = Playlistsong::select('songs.id',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))

        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('albums.id',$albumid)
        ->get();      
 
        return response()->json($song);

        //
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
