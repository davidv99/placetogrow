<?php

namespace App\Http\Controllers;

use App\Constants\DocumentTypes;
use App\Models\microsites;
use App\Http\Requests\StoremicrositesRequest;
use App\Http\Requests\UpdatemicrositesRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use App\Actions\Microsites\StoreAction;

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
        Log::info('Creando un nuevo microsite');
        $categories = Category::query()->select('id', 'name')->get();
        $documentTypes = DocumentTypes::cases();
        Log::info('Tipos de documentos:', $documentTypes);
        return view('microsites.create', compact('categories', 'documentTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremicrositesRequest $request, StoreAction $storeAction): RedirectResponse
    {
        Log::info('SOTREEEEreando un nuevo microsite');
        Log::info('Datos recibidos en el formulario:', $request->all());
        Log::info('Datos validados:', $request->validated());
        $storeAction->execute($request->validated());
        // microsites::create($request->validated());
        return redirect()->route('microsites.index');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(microsites $microsites)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(microsites $microsites)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatemicrositesRequest $request, microsites $microsites)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(microsites $microsites)
    {
        //
    }
}
