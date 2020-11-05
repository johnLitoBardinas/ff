<?php

namespace App\Console\Commands;

use App\Enums\GymVisitationType;
use App\GymVisitation;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MidnightAutoLogout extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'auto:midnightautologoutservice';

    /**
     * The console command description.
     */
    protected $description = 'Use this command to Auto out all the gym services customer currently In at the midnight.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $currentInCustomers = GymVisitation::whereDate('date', Carbon::today())->where('visitation_type', GymVisitationType::IN)->get()->pluck('id');
        $customerOutGym = DB::table('gym_visitation')->whereIn('id', $currentInCustomers)->update(['visitation_type' => GymVisitationType::OUT]);
        if (! empty($customerOutGym)) {
            Log::notice("Auto logout gym services the following" . implode(' ', $currentInCustomers->toArray()));
        }

    }
}
