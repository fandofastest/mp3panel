<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Alert;
use App\Models\Song;
use App\Models\MP3File;
use App\Models\Artist;
use Illuminate\Http\Request;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $artist=Artist::all();

             $song = Song::select('songs.id','songs.file as filemp3','songs.duration as duration','songs.title as songname','songs.cover as songcover','artists.name as artistname','artists.cover as artistcover','genres.name as genrename','genres.cover as genrecover','albums.name as albumname','albums.cover as albumcover')
                        ->join('artists','artists.id','songs.artist_id')
                        ->join('genres','genres.id','songs.genre_id')
                        ->join('albums','albums.id','songs.album_id')
                        ->get();
        // dd($song);
        // $genre=Genre::all();

        return view('song.index', compact('song','artist'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getDetailJson($song_id=null)
    {



        if($song_id==null){
            $song['data']= Song::select('songs.id','songs.file as filemp3','songs.duration as duration','songs.title as songname','songs.cover as songcover','artists.name as artistname','artists.cover as artistcover','genres.name as genrename','genres.cover as genrecover','albums.name as albumname','albums.cover as albumcover')
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->get();
            # code...
        }

        else {
            $song['data']= Song::select('songs.id','songs.file as filemp3','songs.duration as duration','songs.title as songname','songs.cover as songcover','artists.name as artistname','artists.cover as artistcover','genres.name as genrename','genres.cover as genrecover','albums.name as albumname','albums.cover as albumcover')
        ->join('artists','artists.id','songs.artist_id')
        ->join('genres','genres.id','songs.genre_id')
        ->join('albums','albums.id','songs.album_id')
        ->where('songs.id',$song_id)
        ->get();

        }

        // $song->get();

        return response()->json($song);

    }



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
        if($request->hasfile('mp3'))  {
         $title =$request->input('name');
        $filemp3=$request->file('mp3');

        $mp3file = new MP3File($filemp3);//http://www.npr.org/rss/podcast.php?id=510282
        $duration1 = $mp3file->getDurationEstimate();//(faster) for CBR only
        $duration1= gmdate("i:s", $duration1);
        //  dd($duration1);

        $filename=$request->input('name');
        $filename = preg_replace('/\s*/', '', $filename);
        // convert the string to all lowercase
        $filename = strtolower($filename);
        $pathmp3 = Storage::putFileAs('public/songmp3', $request->file('mp3'),$filename.'.'.$filemp3->extension());
        // dd($pathmp3);

        $filelirik=$request->file('lirik');
        $pathlirik = Storage::putFileAs('public/songlirik', $request->file('lirik'),$filename.'.lrc');


        $filecover=$request->file('image');
        $pathcover = Storage::putFileAs('public/songcover', $request->file('image'),$filename.'.'.$filecover->extension());

            $song = new Song();
            $song->title=$title;
            $song->artist_id=$request->input('artist');
            $song->album_id=$request->input('album');
            $song->genre_id=$request->input('genre');
            $song->lyric=$filename.'.lrc';
            $song->cover=$filename.'.'.$filecover->extension();
            $song->file=$filename.'.'.$filemp3->extension();
            $song->duration=$duration1;
            $song->save();
            Alert::success('Success', 'Album Tersimpan');


        }
        else {
            Alert::error('Gagal', 'Album Gagal Tersimpan');

        }
        //
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function show(Song $song)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function edit(Song $song)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        dd("test");

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Song  $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        $song->delete();
        Alert::success('Success', 'Song Berhasil Dihapus');
        return redirect()->route('song.index');
        //
    }
}
