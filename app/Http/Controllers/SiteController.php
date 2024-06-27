<?php

namespace App\Http\Controllers;

use App\Models\Site;
use App\Http\Requests\StoreSiteRequest;
use App\Http\Requests\UpdateSiteRequest;
use App\Models\Category;
use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function Laravel\Prompts\alert;

class SiteController extends Controller
{

    public function index()
    {
        $sites = Site::whereIn('site_type', ['open', 'close', 'suscription'])
                    ->with('category:id,name')
                    ->select('name', 'category_id', 'site_type', 'id')
                    ->get();
        
        $classifiedSites = [
            'OPEN' => [],
            'CLOSE' => [],
            'SUSCRIPTION' => []
        ];

        foreach ($sites as $site) {
            $classifiedSites[$site->site_type][] = $site;
        }

        $open_sites = $classifiedSites['OPEN'];
        $close_sites = $classifiedSites['CLOSE'];
        $suscription_sites = $classifiedSites['SUSCRIPTION'];

        //dd($classifiedSites);

        return view('sites.index', compact(['open_sites', 'close_sites', 'suscription_sites']));
    }

    public function create()
    {
        $categories = Category::all();

        $enumCurrentValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'current_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumCurrentValues, $matches);
        $current_options = explode(',', $matches[1]);
        $current_options = array_map(fn($value) => trim($value, "'"), $current_options);

        $enumSiteTypeValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'site_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumSiteTypeValues, $matches);
        $site_type_options = explode(',', $matches[1]);
        $site_type_options = array_map(fn($value) => trim($value, "'"), $site_type_options);

        $enumDocumentTypeValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'document_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumDocumentTypeValues, $matches);
        $document_types = explode(',', $matches[1]);
        $document_types = array_map(fn($value) => trim($value, "'"), $document_types);

        return view('sites.create', compact('categories', 'current_options', 'site_type_options', 'document_types'));
    }

    public function store(Request $request)
    {
        $request->validate([
          'image' => 'required|image|max:2048' 
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = $image->getClientOriginalName() . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/site_images/', $imageName);

            $site = new Site();

            $site->slug = $request->slug;
            $site->name = $request->name;
            $site->document_type = $request->document_type;
            $site->document = $request->document;
            $site->category_id = $request->category;
            $site->expiration_time = $request->expiration_time;
            $site->current_type = $request->current;
            $site->site_type = $request->site_type;
            $site->image = 'storage/site_images/' . $imageName;
            $site->save();
            
            return redirect()->route('sites.index')
                ->with('status', 'Site created successfully!')
                ->with('class', 'bg-green-500');
        }

        return redirect()->route('sites.index')
                ->with('status', 'Site created unsuccessfully!')
                ->with('class', 'bg-red-500');
    }

    public function show(string $id)
    {
        $site = Site::find($id);

        return view("sites.show", compact('site'));
    }

    public function edit(string $id)
    {
        $site = Site::find($id);

        $categories = Category::all();

        $enumCurrentValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'current_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumCurrentValues, $matches);
        $current_options = explode(',', $matches[1]);
        $current_options = array_map(fn($value) => trim($value, "'"), $current_options);

        $enumSiteTypeValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'site_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumSiteTypeValues, $matches);
        $site_type_options = explode(',', $matches[1]);
        $site_type_options = array_map(fn($value) => trim($value, "'"), $site_type_options);

        $enumDocumentTypeValues = DB::select("SHOW COLUMNS FROM sites WHERE Field = 'document_type'")[0]->Type;
        preg_match('/^enum\((.*)\)$/', $enumDocumentTypeValues, $matches);
        $document_types = explode(',', $matches[1]);
        $document_types = array_map(fn($value) => trim($value, "'"), $document_types);

        return view("sites.edit", compact('site', 'categories', 'current_options', 'site_type_options', 'document_types'));
    }

    public function update(Request $request, Site $site)
    {
        $request->validate([
            'image' => 'required|image|max:2048' 
        ]);

        if ($request->hasFile('image')) {
            if (Storage::exists(str_replace("storage", "public", $site->image))) {
                Storage::delete(str_replace("storage", "public", $site->image));
                alert('success ¡Archivo eliminado correctamente!');
            } else {
                alert('error El archivo no existe o no se pudo eliminar.');
            }

            $image = $request->file('image');
            $imageName = $image->getClientOriginalName() . time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/site_images/', $imageName);

            //dd($site);
            alert($imageName);

            $site->update([
                'slug' => $request['slug'],
                'name' => $request['name'],
                'document_type' => $request['document_type'],
                'document' => $request['document'],
                'category_id' => $request['category'],
                'expiration_time' => $request['expiration_time'],
                'current_type' => $request['current'],
                'site_type' => $request['site_type'],
                'image' => 'storage/site_images/' . $imageName,
            ]);

            alert($request['document_type']);

            return redirect()->route('sites.index')
                    ->with('status', 'Site updated successfully')
                    ->with('class', 'bg-green-500');
        }
        return redirect()->route('sites.index')
                    ->with('status', 'Site updated unsuccessfully')
                    ->with('class', 'bg-red-500');
    }

    public function destroy(Site $site)
    {     
        $site->image = str_replace("storage", "public", $site->image);

        if (Storage::exists(str_replace("storage", "public", $site->image))) {
            Storage::delete(str_replace("storage", "public", $site->image));
            alert('success ¡Archivo eliminado correctamente!');
        } else {
            alert('error El archivo no existe o no se pudo eliminar.');
        }

        $site->delete();

        return redirect()->route('sites.index')
            ->with('status', 'Site deleted successfully')
            ->with('class', 'bg-green-500');
    }
}
