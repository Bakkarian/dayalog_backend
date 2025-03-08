<?php

namespace App\Console\Commands;

use App\Events\TraccarEvent;
use App\Http\Controllers\DispatchedDeviceEventsController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use \Ratchet\Client\Connector as RatchetConnector;
use \React\Socket\Connector as Reactconnector;
use \Ratchet\Client\WebSocket;
use \Ratchet\RFC6455\Messaging\MessageInterface;


class DeviceEventReciever extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:device-event-receiver';

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

        echo "Started";

        $data = Http::get(env('TRACCAR_URL') . '/api/session?token=' . env('TRACCAR_WEBSOCKET_TOKEN'));
        $data->header("Set-Cookie");

        $loop = \React\EventLoop\Loop::get();
        $connector = new RatchetConnector(
            $loop,
            new Reactconnector(['dns' => '8.8.8.8', 'timeout' => 10 ])
        );

        $connector(
            "ws" . substr(env("TRACCAR_URL"), 4) . "/api/socket", [],
            ["Cookie" =>  $data->header("Set-Cookie")]
        )->then(function(WebSocket $conn) {
            $conn->on('message', function(MessageInterface $msg){

                $payload = json_decode($msg->__toString());
                TraccarEvent::dispatch($payload);
                // $positions = $payload?->positions ?? null;

                // if($positions){
                //     collect($positions)->each(function ($postion){
                //         (new DispatchedDeviceEventsController())->processTraccarPosition($postion);
                //     });
                // }
            });

            $conn->on('close', function($code = null, $reason = null) {
                echo "Connection closed ({$code} - {$reason})\n";
                $loop->stop();
            });
        }, function(\Exception $e) use ($loop) {
            echo "Could not connect: {$e->getMessage()}\n";
            $loop->stop();
        });

    }
}
