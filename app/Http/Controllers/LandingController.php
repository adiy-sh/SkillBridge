<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

/**
 * LandingController handles displaying the public SkillBridge landing page.
 * Keeps business logic clean according to strict MVC principles.
 */
class LandingController extends Controller
{
    /**
     * Display the SkillBridge landing page.
     *
     * @return View
     */
    public function index(): View
    {
        return view('landing');
    }
}
