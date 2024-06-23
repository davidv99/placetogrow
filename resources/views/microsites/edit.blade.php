<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar sitio de pago
            </h2>
            <a href="{{ route('microsites.index') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                <em class="fa-solid fa-arrow-left"></em>
            </a>
        </div>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <form action="{{ route('microsites.update', $microsite) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="category_id" class="block text-gray-700">Categorias</label>
                    <select name="category_id" id="category_id" class="w-full border-gray-300 rounded" required>
                        @foreach ($categories as $category)
                            @if ($category->id == $microsite->category_id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @endif
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold text-sm">Nombre</label>
                    <input type="text" name="name" id="name" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $microsite->name }}" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold text-sm">Slug</label>
                    <input type="text" name="slug" id="slug" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $microsite->slug }}" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold text-sm">Tipo de documento</label>
                    <input type="text" name="documentType" id="documentType" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $microsite->documentType }}" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold text-sm">Número de documento</label>
                    <input type="text" name="document" id="document" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $microsite->document }}" />
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 font-semibold text-sm">Fecha de habilitación</label>
                    <input type="text" name="enabled_at" id="enabled_at" class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ $microsite->enabled_at }}" />
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Guardar</button>
            </form>
        </div>
    </div>
</x-app-layout>
