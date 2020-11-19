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

        $song['song'] = Song::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))
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
        $album['album'] = Album::select('.albums.id as id','songs.year','albums.name as name',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as cover'),'albums.deskripsi as deskripsi','genres.name as genre','artists.name as artist')
        ->join('genres','genres.id','albums.genre_id')
        ->join('artists','artists.id','albums.artist_id')
        ->get();

        // $album=Album::all();
        return response()->json($album);

        //
    }

    public function getAllPlaylist()
    {

        $baseapiurl=asset('storage/');
        $playlist['playlist'] = Playlist::select('id','name',DB::raw('CONCAT("'.$baseapiurl.'/playlist/",cover) as cover'))
        ->where('id', '!=' , 1)
        ->get();

        // $album=Album::all();
        return response()->json($playlist);

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

        $song['song'] = Song::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))
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

        $song['song'] = Song::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))
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

        $song['playlist'] = Playlistsong::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'))
        ->join('songs','songs.id','playlistsongs.song_id')
        ->join('artists','artists.id','songs.artist_id')
        ->join('albums','albums.id','songs.album_id')
        ->join('genres','genres.id','songs.genre_id')
        ->where('playlistsongs.playlist_id',$playlistid)
        ->get();

        return response()->json($song);

        //
    }

    public function getTopChart()
    {

        $baseapiurl=asset('storage/');

        $song['song'] = Playlistsong::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'))

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

        $song['song'] = Songs::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'))

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

        $song['song'] = Song::select('songs.id','songs.year',DB::raw('CONCAT("'.$baseapiurl.'/songmp3/",songs.file) as filemp3'),'songs.duration as duration','songs.title as songname',DB::raw('CONCAT("'.$baseapiurl.'/songcover/",songs.cover) as songcover'),'artists.name as artistname',DB::raw('CONCAT("'.$baseapiurl.'/artist/",artists.cover) as artistcover'),'genres.name as genrename',DB::raw('CONCAT("'.$baseapiurl.'/genre/",genres.cover) as genrecover'),'albums.name as albumname',DB::raw('CONCAT("'.$baseapiurl.'/album/",albums.cover) as albumcover'),DB::raw('CONCAT("'.$baseapiurl.'/songlirik/",songs.lyric) as lyric'))

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
