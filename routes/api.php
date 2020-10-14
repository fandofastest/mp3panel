<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtistController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\SongController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\MobileController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('artist/{artistid}', [ArtistController::class, 'getDetailJson'])->name('getDetailArtist');
Route::get('album/{albumid}', [AlbumController::class, 'getDetailJson'])->name('getDetailAlbum');
Route::get('song/{songid?}', [SongController::class, 'getDetailJson'])->name('getDetailSong');
Route::post('song/update', [SongController::class, 'update'])->name('update');

Route::get('getplaylist/{songid}', [PlaylistController::class, 'getPlaylist'])->name('getPlaylist');
Route::get('addtoplaylist/{playlist_id}/{songid}', [PlaylistController::class, 'addtoplaylist'])->name('addtoplaylist');
Route::get('rmplaylist/{playlist_id}/{songid}', [PlaylistController::class, 'rmplaylist'])->name('rmplaylist');
Route::get('listsongbyplaylist/{playlist_id}', [PlaylistController::class, 'listsongbyplaylist'])->name('listsongbyplaylist');
Route::get('listallsongbyplaylist/{playlist_id}', [PlaylistController::class, 'listallsongbyplaylist'])->name('listallsongbyplaylist');




Route::get('mobile/', [MobileController::class, 'index'])->name('index');
Route::get('mobile/{title}/', [MobileController::class, 'getSongByTitle'])->name('getSongByTitle');
Route::get('mobile/get/{idsong}/{isLocal}/', [MobileController::class, 'getSongById'])->name('getSongById');
Route::get('mobile/playlistsong/{playlistid}/', [MobileController::class, 'getSongByPlaylist'])->name('getSongByPlaylist');
Route::get('mobile/genre/{genrename}/', [MobileController::class, 'getSongByGenre'])->name('getSongByGenre');
Route::get('mobile/album/{albumid}/', [MobileController::class, 'getSongByAlbum'])->name('getSongByAlbum');


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
