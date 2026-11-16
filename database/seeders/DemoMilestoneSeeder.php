<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class DemoMilestoneSeeder extends Seeder
{
    public function run(): void
    {
        $project = Project::find(2);

        if (! $project) {
            $this->command->error('No project found. Create a project on the site first, then run this again.');
            return;
        }

        $project->milestones()->delete();

        $make = fn (string $title, string $status, int $days, string $criteria, float $amount) =>
            $project->milestones()->create([
                'title' => $title,
                'description' => "Demo milestone: {$title}",
                'acceptance_criteria' => $criteria,
                'amount' => $amount,
                'due_date' => now()->addDays($days)->toDateString(),
                'status' => $status,
            ]);

        $plan     = $make('Requirements and Planning', 'completed', -20, 'Requirements document approved by the client', 200);
        $design   = $make('Design Mockups', 'completed', -10, 'Mockups for all screens approved', 300);
        $backend  = $make('Backend Development', 'in_progress', 10, 'All API endpoints working and reviewed', 800);
        $testing  = $make('Testing and Fixes', 'pending', 20, 'No open critical bugs', 400);
        $delivery = $make('Final Delivery', 'pending', 30, 'Client signs off on the final build', 300);
        $feedback = $make('Client Feedback Round', 'in_progress', -3, 'Feedback list resolved', 150);

        $design->dependencies()->sync([$plan->id]);
        $backend->dependencies()->sync([$design->id]);
        $testing->dependencies()->sync([$backend->id]);
        $delivery->dependencies()->sync([$testing->id]);
        $feedback->dependencies()->sync([$plan->id]);

        $this->command->call('milestones:detect-overdue');
        $this->command->info('Demo milestones created for project: ' . $project->title);
    }
}