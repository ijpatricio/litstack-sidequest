<?php

namespace App\Http\Controllers;

use Ignite\Support\Facades\Form;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Load the welcome page.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function show(Request $request)
    {
        $page = Form::load('pages', 'welcome');

        return view('welcome')->with('page', $page);
    }
}
