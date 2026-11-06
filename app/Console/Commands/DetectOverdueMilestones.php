<?php

namespace App\Console\Commands;

use App\Models\Milestone;
use Illuminate\Console\Command;

class DetectOverdueMilestones extends Command
{
    protected $signature = 'milestones:detect-overdue';
    protected $description = 'Flag milestones past their due date that are not completed';

    public function handle(): int
    {
        $flagged = Milestone::where('status', '!=', 'completed')
            ->whereDate('due_date', '<', now()->toDateString())
            ->where('is_overdue', false)
            ->update(['is_overdue' => true]);

        // Clear the flag if a milestone was completed or its due date was moved
        $cleared = Milestone::where('is_overdue', true)
            ->where(function ($q) {
                $q->where('status', 'completed')
                  ->orWhereDate('due_date', '>=', now()->toDateString());
            })
            ->update(['is_overdue' => false]);

        $this->info("Flagged: {$flagged}, cleared: {$cleared}");
        return self::SUCCESS;
    }
}