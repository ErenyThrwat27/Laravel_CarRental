<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
     public function __construct()
     {
         $this->middleware('auth');
     }

   
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testemonials=Testimonial::get();
        return view('admin.testimonials',compact('testemonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.addTestimonials');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required|string|max:255',
        //     'position' => 'required|string|max:255',
        //     'content' => 'required|string',
        //     'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
        $testemonials=new Testimonial();
        $testemonials->name=$request->name;
        $testemonials->position=$request->position;
        $testemonials->content=$request->content;
        $testemonials->image=$request->image;
        $testemonials->save();
        return redirect('/admin/testimonials');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $testimonials = Testimonial::get();
        return view('testimonials',compact('testimonials'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $testimonials=Testimonial::find($id);
        return view('admin.editTestimonials',compact('testimonials'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $testemonials=Testimonial::find($id);
        $testemonials->name=$request->name;
        $testemonials->position=$request->position;
        $testemonials->content=$request->content;
        $testemonials->image=$request->image;
        $testemonials->save();
        return redirect('/admin/testimonials');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial=Testimonial::find($id)->delete();
        return redirect('/admin/testimonials');
    }
}
