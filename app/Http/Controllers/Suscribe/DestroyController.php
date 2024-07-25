<?php

namespace App\Http\Controllers\Suscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class DestroyController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $request->user()->subscription()->cancel();
        return Redirect::route('dashboard');
    }
}
