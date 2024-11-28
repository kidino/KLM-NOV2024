<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;

class SetExpiredStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:set-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Set status to expired for expired users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $users = User::where('status', '!=', 'expired')
            ->whereNotNull('expiry_date')
            ->whereDate('expiry_date', '<', $today)
            ->get();    
        
        foreach($users as $user) {
            $this->info( $user->name );
            $user->status = 'expired';
            $user->save();
        }
        $this->info( 'Done - found ' . $users->count() );
    }
}
