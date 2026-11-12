<?php

use App\Http\Controllers\FreelancerProfileController;
use App\Http\Controllers\FreelancerPublicProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\MilestoneController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectDiscoveryController;
use App\Http\Controllers\SkillEndorsementController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| SkillBridge web routes. The root path serves the landing page via LandingController.
|
*/

Route::get('/', [LandingController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    // ── Breeze profile ────────────────────────────────────────────────────────
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Project discovery (all authenticated users) ───────────────────────────
    // Registered BEFORE the client resource so /projects resolves here, not to index()
    Route::get('/projects', [ProjectDiscoveryController::class, 'index'])->name('projects.index');

    // ── Client project management ─────────────────────────────────────────────
    // /projects/create must be before /projects/{project} to avoid clash
    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    Route::patch('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::patch('/projects/{project}/close', [ProjectController::class, 'close'])->name('projects.close');

    // Client's own project list (separate from discovery)
    Route::get('/my-projects', [ProjectController::class, 'index'])->name('my-projects.index');

    // ── Milestones (Walid's module — untouched) ───────────────────────────────
    Route::resource('projects.milestones', MilestoneController::class)->except('show');

    // ── Freelancer profile & skills ───────────────────────────────────────────
    Route::get('/freelancer/profile', [FreelancerProfileController::class, 'edit'])->name('freelancer.profile.edit');
    Route::patch('/freelancer/profile', [FreelancerProfileController::class, 'update'])->name('freelancer.profile.update');
    Route::post('/freelancer/skills', [FreelancerProfileController::class, 'addSkill'])->name('freelancer.skills.add');
    Route::delete('/freelancer/skills/{userSkill}', [FreelancerProfileController::class, 'removeSkill'])->name('freelancer.skills.remove');

    // ── Portfolio (freelancer) ────────────────────────────────────────────────
    Route::resource('portfolio', PortfolioController::class)->except('show');

    // ── Skill endorsements ────────────────────────────────────────────────────
    Route::post('/endorsements', [SkillEndorsementController::class, 'store'])->name('endorsements.store');
    Route::delete('/endorsements/{skillEndorsement}', [SkillEndorsementController::class, 'destroy'])->name('endorsements.destroy');

    // ── Public freelancer profiles ────────────────────────────────────────────
    Route::get('/freelancers/{user}', [FreelancerPublicProfileController::class, 'show'])->name('freelancers.show');
});

require __DIR__ . '/auth.php';
