<?php

namespace App\Http\Controllers;

use App\Models\Artist;
use App\Models\Artwork;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    //
    public function index($artist)
    {
        $artistInfo = Artist::where('name', '=', $artist)->first();
        $artistArtworks = Artwork::where('artist_id', '=', $artistInfo->id)->paginate(8);
        return view('livewire.pages.artist.index', [
            'artist' => $artistInfo,
            'artistArtworks' => $artistArtworks
        ]);
    }
}
