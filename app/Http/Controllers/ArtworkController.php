<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ArtworkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $artworks = Artwork::where('is_sold', 0)->latest()->paginate(8);
        return view('livewire.pages.index', [
            'artworks' => $artworks,
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        //
        $artwork = Artwork::findOrFail($id);
        return view('livewire.pages.show', [
            'artwork' => $artwork
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id, Request $request)
    {
        //
        $title = 'Edit';
        $artwork = Artwork::find($id);
        $categories = Category::where('id', '!=', $artwork->category_id)->get();
        return view('livewire.pages.artwork.edit', [
            'title' => $title,
            'artwork' => $artwork,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $artwork = Artwork::find($id);

        $validatedForm = $request->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'category_id' => ['required'],
            'created_date' => ['required', 'min:3'],
            'medium' => ['nullable'],
            'size' => ['nullable'],
        ]);

        $attributes = [
            'title',
            'description',
            'created_date',
            'medium',
            'size',
        ];

        $hasChange = false;

        foreach ($attributes as $attribute) {
            if ($artwork->$attribute !== $request->$attribute) {
                $artwork->$attribute = $request->$attribute;
                $hasChange = true;
            }
        }
        if ((int)$request->category_id !== $artwork->category_id) {
            $artwork->category_id = $request->category_id;
            $hasChange = true;
        }
        if ((float)$request->price !== $artwork->price) {
            $artwork->price = $request->price;
            $hasChange = true;
        }

        if ($request->artwork_image) {
            $fileName = time() . '.' . $request->artwork_image->extension();
            $request->artwork_image->storeAs('public', $fileName);
            $artwork->artwork_image = $fileName;
            $hasChange = true;
        }

        if ($hasChange) {
            $artwork->save();
            return back()
                ->with('success', 'Artwork updated');
        }

        return back()
            ->with('error', 'No changes were made');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $artwork = Artwork::find($id);
        $artwork->delete();
        return to_route('home')
            ->with('success', 'Artwork deleted');
    }
}
