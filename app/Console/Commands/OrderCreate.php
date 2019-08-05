<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Order;
use App\User;

class OrderCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:create {product_id*}';

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
        $productsId = $this->argument('product_id');

        $api_token = $this->secret('What is the api_token?');

        if($api_token) {
            $user = User::where('api_token', $api_token)->first();

            if($user) {
                $order = new Order;
                $order->status_id = 1;

                $order->user_id = $user->id;
                $order->save();
    
                foreach($productsId as $product) {
                    $order->products()->attach($product);    
                }
                $order->save();

                $this->line('Order Create ' . $order->id);   
            } else {
                
                $this->error('error! not access 403');    
            }
        }
    }
}
