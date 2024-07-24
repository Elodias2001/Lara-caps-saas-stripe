<?php

namespace App\Http\Controllers\Suscribe;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return view('subscribe.create',[
            'intent' => auth()->user()->createSetupIntent(),
        ]);
    }
}
