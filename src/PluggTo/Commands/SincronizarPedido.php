<?php

namespace PluggTo\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use PluggTo\Jobs\BaixaPedidos;

class SincronizarPedido extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pluggTo:sincronizarPedido';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sincroniza os pedidos com a pluggTo';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = config('pluggTo.user_model')::all();
        foreach ($users as $user) {
            dispatch((new BaixaPedidos($user->plugg_id))->onQueue('pluggToPedidos'));
        }
    }
}
