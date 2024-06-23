<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{$microsite->name}}
        </h2>
    </x-slot>
    <div class="flex w-full justify-center my-4">
        <div class="container align-middle p-4 sm:p-6 lg:p-8 bg-white">
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.category') }}</label>
                <p class="text-gray-900">{{ $microsite->category->name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.slug') }}</label>
                <p class="text-gray-900">{{ $microsite->slug }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.name') }}</label>
                <p class="text-gray-900">{{ $microsite->name }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.document_type') }}</label>
                <p class="text-gray-900">{{ $microsite->documentType }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.document') }}</label>
                <p class="text-gray-900">{{ $microsite->document }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.status') }}</label>
                <p class="text-gray-900">{{trans('sites.' . $microsite->enabled_at ? 'enabled' : 'disabled') }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.created_at') }}</label>
                <p class="text-gray-900">{{ $microsite->created_at }}</p>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">{{ trans('sites.updated_at') }}</label>
                <p class="text-gray-900">{{ $microsite->updated_at }}</p>
            </div>
        </div>
    </div>
</x-app-layout>