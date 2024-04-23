<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\Dispatch;
use App\Models\User;
use App\Mail\DailyDriversSummary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class DriverSummaryEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:driver-summary-emails';

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

                        // Get the current date and time
            $today = Carbon::now();

            // Subtract one day to get yesterday's date
            $yesterday = $today->subDay();

            // Query dispatches created yesterday
            $dispatches = Dispatch::whereDate('created_at', $yesterday)->with([
                'orderVehicle.vehicle.device',
                'orderVehicle.vehicle.driver.bioData',
            ])->get();


            // Group the dispatches by driver
            $dispatchesGroupedByDriver = $dispatches->groupBy(function ($dispatch) {
                $dispatch->distance = $dispatch->getDistance();
                return optional($dispatch->orderVehicle->vehicle->driver->bioData)->id ?? '0';
            });


            $data = $dispatchesGroupedByDriver->mapWithKeys(function($data, $key){

                $totalDistance = $data->reduce(function (?int $carry, $item) {
                        return $carry + $item->distance;
                });

                $user = $data[0]->orderVehicle->vehicle->driver->bioData;

                return [$key => [
                    'user' =>  $user,
                    'distance' => $totalDistance / 1000,
                    'number_of_dispatches' => count($data),
                ]];

            });

            $data = $data->values();

            Mail::to(['afashaisakiye@gmail.com', 'ivanatresyn@gmail.com'])->send(new DailyDriversSummary($data));
    }
}
