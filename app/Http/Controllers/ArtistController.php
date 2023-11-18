<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\ImageManagerStatic as Image;

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
            'medium' => ['nullable'],
            'size' => ['nullable'],
            'artwork_image' => ['required'],
        ]);
        $fileName = "iGallery-" . time() . '.webp';

        $artworkImg = Image::make($request->artwork_image);
        $artworkImg->save(public_path('storage/' . $fileName), 20, "webp");
        $validatedForm['artwork_image'] = $fileName;
        $validatedForm['artist_id'] = $artist_id;
        Artwork::create($validatedForm);
        return to_route('home')
            ->with('success', 'Artwork uploaded');
    }
}
