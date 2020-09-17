<?php

namespace App\Observers;

use App\Adjunto;
use Illuminate\Support\Facades\Storage;

class AdjuntoObserver
{
    public function deleted(Adjunto $adjunto)
    {

        $ficheroPath = str_replace('/storage', '', $adjunto->path);

       	Storage::delete($ficheroPath);
    }
}
