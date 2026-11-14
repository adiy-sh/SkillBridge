<?php

namespace App\Services;

use App\Models\EscrowLedger;
use App\Models\Milestone;
use Illuminate\Support\Facades\DB;

class EscrowService
{
    public function fundMilestone(Milestone $milestone, float $amount, int $payerId): EscrowLedger
    {
        return DB::transaction(function () use ($milestone, $amount, $payerId) {
            $ledger = EscrowLedger::create([
                'milestone_id' => $milestone->id,
                'payer_id' => $payerId,
                'payee_id' => $milestone->project->user_id ?? 1, // falls back safely to project owner
                'amount' => $amount,
                'status' => 'held',
            ]);

            $milestone->update(['status' => 'funded']);

            return $ledger;
        });
    }

   
    public function releaseEscrow(EscrowLedger $ledger): bool
    {
        return DB::transaction(function () use ($ledger) {
            $ledger->update(['status' => 'released']);
            
            $ledger->milestone()->update(['status' => 'released']);

            return true;
        });
    }

    public function refundMilestone(Milestone $milestone, int $userId): EscrowLedger
    {
        return DB::transaction(function () use ($milestone, $userId) {
            $ledger = $milestone->escrowLedger;
        
            if (!$ledger || $ledger->status !== 'held') {
              throw new \Exception('Milestone is not currently held in escrow.');
            }

            $ledger->update(['status' => 'refunded']);
            $milestone->update(['status' => 'pending']); // or 'refunded'

            return $ledger;
        }); 
    }
}