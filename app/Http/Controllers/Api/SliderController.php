<?php

namespace App\Http\Controllers\Api;

use App\Models\Slider;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return response()->json([
            'success'   => true,
            'message'   => 'List Data Sliders',
            'sliders'   => $sliders
        ]);
    }
}
