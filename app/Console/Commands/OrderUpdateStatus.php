<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Order;
use App\User;

class OrderUpdateStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:update {order_id} {status_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $orderId = $this->argument('order_id');
        $statusId = $this->argument('status_id');

        if($orderId ||  $statusId) {
            $this->error('error! not data');
        }

        $api_token = $this->secret('What is the api_token?');

        if($api_token) {
            $user = User::where('api_token', $api_token)->first();

            if($user) {
                $obOrder = Order::find($orderId)->first();

                if($obOrder) {
                    $obOrder->status_id = $statusId;
                    $obOrder->save();

                    $this->line('Status Update for Order ' . $orderId);
                }  
                
            } else {
                $this->error('error! not access 403');      
            }
        }

    }
}
