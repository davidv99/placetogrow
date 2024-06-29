<?php

namespace App\Http\Controllers;

use App\Actions\Microsites\DeleteAction;
use App\Constants\DocumentTypes;
use App\Constants\PolicyName;
use App\Models\Microsites;
use App\Models\Category;
use App\Http\Requests\StoremicrositesRequest;
use App\Http\Requests\UpdatemicrositesRequest;
use Illuminate\Http\RedirectResponse;
use App\Actions\Microsites\StoreAction;

class MicrositesController extends Controller
{
    public function index()
    {
        $this->authorize(PolicyName::VIEW_ANY, Microsites::class);
        $microsites = Microsites::all();
        return view('microsites.index', compact('microsites'));
    }

    public function create()
    {
        $this->authorize(PolicyName::CREATE, Microsites::class);
        $categories = Category::query()->select('id', 'name')->get();
        $documentTypes = DocumentTypes::cases();
        return view('microsites.create', compact('categories', 'documentTypes'));
    }

    public function store(StoremicrositesRequest $request, StoreAction $storeAction): RedirectResponse
    {
        $this->authorize(PolicyName::CREATE, Microsites::class);
        $storeAction->execute($request->validated());
        return redirect()->route('microsites.index');
    }

    public function show(microsites $microsite)
    {
        $this->authorize(PolicyName::VIEW, $microsite);
        return view('microsites.show', compact('microsite'));
    }

    public function edit(microsites $microsite, Category $category)
    {
        $this->authorize(PolicyName::UPDATE, $microsite);
        $categories = Category::query()->select('id', 'name')->get();
        $documentTypes = DocumentTypes::cases();

        return view('microsites.edit', compact('microsite', 'categories', 'documentTypes'));
    }

    public function update(UpdatemicrositesRequest $request, microsites $microsite): RedirectResponse
    {
        $this->authorize(PolicyName::UPDATE, $microsite);
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
        $micrositse = Microsites::find($microsite->id);
        $this->authorize(PolicyName::DELETE, $microsite);
        $deleteAction->execute($micrositse);
        return redirect()->route('microsites.index');
    }
}
