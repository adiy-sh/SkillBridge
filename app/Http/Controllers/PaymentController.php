<?php

namespace App\Http\Controllers;

use App\Services\EscrowService;
use App\Models\Milestone;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    protected EscrowService $escrowService;

    public function __construct(EscrowService $escrowService)
    {
        $this->escrowService = $escrowService;
    }

    public function show(Milestone $milestone)
    {
        $milestone->load('escrowLedger');
        return view('payments.escrow', compact('milestone'));
    }

    public function fund(Request $request, Milestone $milestone)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $this->escrowService->fundMilestone($milestone, $request->amount, auth()->id());

        return back()->with('success', 'Milestone funded successfully. Funds are secured in escrow.');
    }

    public function release(Request $request, Milestone $milestone)
    {
        // Ensure milestone is marked completed before releasing funds
        if ($milestone->status !== 'completed') {
            return back()->with('error', 'Milestone must be marked as Completed before funds can be released from escrow.');
        }

        $this->escrowService->releaseMilestone($milestone, auth()->id());

        return back()->with('success', 'Milestone funds released successfully to the freelancer.');
    }

    public function refund(Request $request, Milestone $milestone)
    {
        $this->escrowService->refundMilestone($milestone, auth()->id());

        return back()->with('success', 'Escrow funds refunded successfully to the client.');
    }
}