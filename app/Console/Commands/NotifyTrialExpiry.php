<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class NotifyTrialExpiry extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:notify-trial-expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()

    {
        $users = User::where('on_trial', true)
            ->where('trial_end_date', '<=', now()->addDays(2))
            ->get();

        foreach ($users as $user) {
            // Send notification or email
            $user->notify(new NotifyTrialExpiry($user));
        }

        $this->info('Trial expiry notifications sent.');
    }
}
