<?php

namespace App\Actions\Microsites;

use App\Models\microsites;
use Illuminate\Support\Facades\Log;

class DeleteAction
{
    public function execute(microsites $microsites): void
    {
        $microsites->delete();
    }
}
