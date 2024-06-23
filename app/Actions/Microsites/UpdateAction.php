<?php

namespace App\Actions\Microsites;

use App\Models\microsites;
use Illuminate\Support\Facades\Log;

class UpdateAction
{
    public function execute(array $data): microsites
    {
        Log::info('UpdateAction: ', $data);
        $microsite = new microsites();
        $microsite->category_id = $data['category_id'];
        $microsite->slug = $data['slug'];
        $microsite->name = $data['name'];
        $microsite->document_type = $data['document_type'];
        $microsite->document_number = $data['document_number'];
        $microsite->logo = 'https://www.eafit.edu.co/estudiantes/feriaempleo/PublishingImages/logos/evertec-logo.jpg';
        $microsite->currency = 'COP';
        $microsite->site_type = 'Invoice';
        $microsite->enabled_at = now();
        $microsite->save();

        return $microsite;
    }
}