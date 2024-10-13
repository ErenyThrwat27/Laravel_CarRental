<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class MaintestimonialController extends Controller
{
    public function testimonial(){

        $testimonials = Testimonial::get();
        return view('testimonials',compact('testimonials'));

    }
}
