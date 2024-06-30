<?php

namespace App\Http\Controllers;

use App\Http\Requests\Site\StoreRequest;
use App\Http\Requests\Site\UpdateRequest;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class SiteController extends Controller
{

    public function index()
    {
        $sites = Site::where('user_id', Auth::id())->get();
        return Inertia::render('Site/Index', compact('sites'));
    }

    public function create()
    {
        $categories = Category::all();
        return Inertia::render('Site/Create', [
            'categories' => $categories,
        ]);

    }

    public function store(StoreRequest $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $data = $request->except('logo');

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $routeName = $file->store('logos', ['disk'=>'public']);
            $data['logo'] = $routeName;
        }
        $data['user_id'] = Auth::user()->id;

        Site::create($data);

        return to_route('site.index');
    }

    public function show(Site $site)
    {
        return Inertia::render('Site/Show', compact('site'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Site $site)
    {
        return Inertia::render('Site/Edit', compact('site'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Site $site)
    {
        $data = $request->except('logo');

        if($request->hasFile('logo')){
            $file = $request->file('logo');
            $routeName = $file->store('logos', ['disk'=>'public']);
            $data['logo'] = $routeName;

            if($site->logo){
                Storage::disk('public')->delete($site->logo);
            }
        }

        $site->update($data);

        return to_route('site.edit',$site);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Site $site)
    {
        if($site->logo){
            Storage::disk('public')->delete($site->logo);
        }
        $site->delete();
        return to_route('site.index');
    }
}


