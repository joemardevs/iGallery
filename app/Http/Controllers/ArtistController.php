<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\User;
use Illuminate\Http\Request;

class ArtistController extends Controller
{
    //
    public function index($artist)
    {
        $artistInfo = User::where('name', '=', $artist)->first();
        $artistArtworks = Artwork::where('artist_id', '=', $artistInfo->id)->paginate(8);
        return view('livewire.pages.artist.index', [
            'artist' => $artistInfo,
            'artistArtworks' => $artistArtworks
        ]);
    }
}
