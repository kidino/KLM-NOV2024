<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Console\Command;
use App\Mail\ExpiryReminderMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ExpiryReminderEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:expiry-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To send email reminder to users where membership is to expire in 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $reminderDate = Carbon::now()->addDays(30)->toDateString();

        $this->info($reminderDate);

        $users = User::where('expiry_date', '>=', $reminderDate.' 00:00:00')
        ->where('expiry_date', '<=', $reminderDate.' 23:59:59')
        ->get();

        foreach($users as $user){
            $this->info(' -'.$user->name);
            Mail::to($user->email)->send(new ExpiryReminderMail( $user ));
            $this->info(' -- email reminder sent');
        }

        $this->info($users->count());
    }
}
