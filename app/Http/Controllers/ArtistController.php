<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
    public function uploadArtworkIndex()
    {
        $title = 'Upload';
        $categories = Category::all();

        return view('livewire.pages.artwork.upload', [
            'title' => $title,
            'categories' => $categories
        ]);
    }
    public function uploadArtwork(Request $request)
    {
        $artist_id = auth()->user()->id;
        $validatedForm = $request->validate([
            'title' => ['required', 'min:3', Rule::unique('artworks', 'title')],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required'],
            'created_date' => ['required', 'min:3'],
            'artwork_image' => ['required'],
        ]);
        $fileName = time() . '.' . $request->artwork_image->extension();
        $request->artwork_image->storeAs('public', $fileName);
        $validatedForm['artwork_image'] = $fileName;
        $validatedForm['artist_id'] = $artist_id;
        Artwork::create($validatedForm);
        return to_route('home')
            ->with('success', 'Artwork uploaded');
    }
}
