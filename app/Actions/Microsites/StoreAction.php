<?php

namespace App\Actions\Microsites;

use App\Models\Microsites;

class StoreAction
{
    public function execute(array $data): Microsites
    {
        $microsite = new Microsites();
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