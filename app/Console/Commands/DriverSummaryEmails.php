<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Mail\DailyDriversSummary;
use App\Models\Device;
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

        $today = Carbon::now();
        $yesterday = $today->subDays(1);

        //$DevicePosition::whereDate('servertime', $yesterday)->get()

        $devices = Device::all();
        $data = $devices->map(function ($device) use ($yesterday){

              $devicePositions = $device->positions()->whereDate('servertime', $yesterday)->get();

              $firstPosition = $devicePositions->first();
              $lastPosition = $devicePositions->last();

              if($firstPosition){
                $lastTotalDistance = json_decode($lastPosition?->attributes, true)['totalDistance'];
                $firstTotalDistance = json_decode($firstPosition?->attributes, true)['totalDistance'];

                $totalDailydistance = ($lastTotalDistance - $firstTotalDistance) / 1000;

              }


              $vehicle = $device->vehicle;

              if($vehicle){
                $user = $vehicle->driver?->bioData;
              }


              if($vehicle){
                    $dispatches = $vehicle->dispatches()->get();
                    $dispatchDistance = ($dispatches->reduce(
                                          function (?int $carry, $item) {
                                                return $carry + $item->distance;
                                        })) / 1000;
              }

              return  [
                'user' =>  $user ?? null,
                'totalDailydistance' => $totalDailydistance ?? 0,
                'dispatchDistance' => $dispatchDistance ?? 0,
            ];
        });



            Mail::to([
                'afashaisakiye@gmail.com',
                'ivanatresyn@gmail.com'
            ])->send(new DailyDriversSummary($data));
    }
}
