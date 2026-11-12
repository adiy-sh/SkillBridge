<?php

namespace App\Http\Controllers;

use App\Http\Requests\PortfolioItemRequest;
use App\Models\FreelancerProfile;
use App\Models\PortfolioItem;
use App\Services\PortfolioFileService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PortfolioController extends Controller
{
    public function __construct(private readonly PortfolioFileService $fileService)
    {
    }

    /**
     * List the authenticated freelancer's portfolio items.
     */
    public function index(Request $request): View
    {
        $user    = $request->user();
        abort_unless($user->isFreelancer(), 403);

        $profile = $user->freelancerProfile
                ?? FreelancerProfile::create(['user_id' => $user->id]);

        $items = $profile->portfolioItems;

        return view('portfolio.index', compact('profile', 'items'));
    }

    public function create(Request $request): View
    {
        abort_unless($request->user()->isFreelancer(), 403);

        $types = config('skillbridge.portfolio_types');

        return view('portfolio.create', compact('types'));
    }

    public function store(PortfolioItemRequest $request): RedirectResponse
    {
        $user    = $request->user();
        $profile = $user->freelancerProfile
                ?? FreelancerProfile::create(['user_id' => $user->id]);

        $data = $request->safe()->except('file');

        if ($request->hasFile('file')) {
            $data['file_path'] = $this->fileService->store($request->file('file'));
        }

        $profile->portfolioItems()->create($data);

        return redirect()->route('portfolio.index')
                         ->with('success', 'Portfolio item added.');
    }

    public function edit(PortfolioItem $portfolioItem): View
    {
        $this->authorize('update', $portfolioItem);

        $types = config('skillbridge.portfolio_types');

        return view('portfolio.edit', ['item' => $portfolioItem, 'types' => $types]);
    }

    public function update(PortfolioItemRequest $request, PortfolioItem $portfolioItem): RedirectResponse
    {
        $this->authorize('update', $portfolioItem);

        $data = $request->safe()->except('file');

        if ($request->hasFile('file')) {
            // Remove old file if replacing
            if ($portfolioItem->file_path) {
                $this->fileService->delete($portfolioItem->file_path);
            }
            $data['file_path'] = $this->fileService->store($request->file('file'));
        }

        $portfolioItem->update($data);

        return redirect()->route('portfolio.index')
                         ->with('success', 'Portfolio item updated.');
    }

    public function destroy(PortfolioItem $portfolioItem): RedirectResponse
    {
        $this->authorize('delete', $portfolioItem);

        if ($portfolioItem->file_path) {
            $this->fileService->delete($portfolioItem->file_path);
        }

        $portfolioItem->delete();

        return redirect()->route('portfolio.index')
                         ->with('success', 'Portfolio item removed.');
    }
}

