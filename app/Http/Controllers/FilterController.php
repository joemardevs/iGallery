<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('livewire.pages.filter.index', [
            'categories' => $categories
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
    public function show(Request $request)
    {
        // Get the category query parameter from the request
        $category = $request->category;
        $minPrice = $request->minPrice;
        $maxPrice = $request->maxPrice;

        // Start building the query
        $artworksQuery = Artwork::query();

        //check if theres a value in the input for the query
        if (isset($category) || isset($minPrice) || isset($maxPrice)) {
            // Filter by category
            if ($category) {
                $artworksQuery->whereHas('category', function ($query) use ($category) {
                    $query->where('name', 'like', "%$category%");
                });
            }

            // Filter by price range
            if ($minPrice !== null && $minPrice !== '') {
                $artworksQuery->where('price', '>=', $minPrice);
            }

            if ($maxPrice !== null && $maxPrice !== '') {
                $artworksQuery->where('price', '<=', $maxPrice);
            }

            // Get the filtered artworks
            $artworks = $artworksQuery->paginate(8);
            return view('livewire.pages.filter.show', [
                'artworks' => $artworks,
                'title' => $category
            ]);
        } else {
            //if theres no value in the input for the query then redirect to home
            return to_route('filter');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
