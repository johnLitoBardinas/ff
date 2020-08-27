<?php

namespace App\Console\Commands;

use App\CustomerPackage;
use App\Enums\CustomerPackageStatus;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckCustomerPackageExpiration extends Command
{
    /**
     * The name and signature of the console command.
     */
    protected $signature = 'check:customerpackageexpiration';

    /**
     * The console command description.
     */
    protected $description = 'Run this command to check for expired customer package.';

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
        $checkingCustomerPackage = CustomerPackage::where('customer_package_end', '<', Carbon::now())
                                    ->where('customer_package_status', CustomerPackageStatus::ACTIVE)
                                    ->update(['customer_package_status' => CustomerPackageStatus::EXPIRED]);

        Log::notice('Finished Checked on Customer Expired Package');
        $this->info('Total Expired Customer Package =>' . $checkingCustomerPackage);
    }
}
