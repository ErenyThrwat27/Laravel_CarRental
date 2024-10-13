<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

class LanguageController extends Controller
{
    public function langswitch(Request $request){
        $language =$request->language;
        App::setLocale($language);
        session::put('locale',$language);
        return redirect()->back()->with(['language_switched'=>$language]);

    }
}
