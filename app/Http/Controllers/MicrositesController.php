<?php

namespace App\Http\Controllers;

use App\Actions\Microsites\DeleteAction;
use App\Constants\DocumentTypes;
use App\Models\microsites;
use App\Http\Requests\StoremicrositesRequest;
use App\Http\Requests\UpdatemicrositesRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Actions\Microsites\StoreAction;
use App\Actions\Microsites\UpdateAction;
use App\Http\Requests\EditmicrositesRequest;
use Illuminate\Http\Request;

class MicrositesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $microsites = microsites::all();
        return view('microsites.index', compact('microsites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::query()->select('id', 'name')->get();
        $documentTypes = DocumentTypes::cases();
        return view('microsites.create', compact('categories', 'documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremicrositesRequest $request, StoreAction $storeAction): RedirectResponse
    {
        $storeAction->execute($request->validated());
        return redirect()->route('microsites.index');
    }

    public function show(microsites $microsite)
    {
        return view('microsites.show', compact('microsite'));
    }

    public function edit(microsites $microsite, Category $category)
    {
        $categories = Category::query()->select('id', 'name')->get();
        $documentTypes = DocumentTypes::cases();

        return view('microsites.edit', compact('microsite', 'categories', 'documentTypes'));
    }
    public function update(UpdatemicrositesRequest $request, microsites $microsite): RedirectResponse
    {
        $request->validate([
            'category_id' => 'required',
            'slug' => 'required|max:50',
            'name' => 'required|max:100',
        ]);

        $microsite->update($request->all());
        return redirect()->route('microsites.index');
    }


    public function destroy(microsites $microsite, DeleteAction $deleteAction): RedirectResponse
    {
        $deleteAction->execute($microsite);
        return redirect()->route('microsites.index');
    }
}
