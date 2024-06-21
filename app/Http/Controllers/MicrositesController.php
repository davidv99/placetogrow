<?php

namespace App\Http\Controllers;

use App\Models\microsites;
use App\Http\Requests\StoremicrositesRequest;
use App\Http\Requests\UpdatemicrositesRequest;

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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoremicrositesRequest $request)
    {
        //
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
