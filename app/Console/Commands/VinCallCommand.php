<?php

namespace App\Console\Commands;

use App\Http\Controllers\CallController;
use App\Http\Controllers\Controller;
use App\Models\VinDataCounter;
use Dflydev\DotAccessData\Data;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class VinCallCommand extends Command
{
    protected $signature = 'app:vin-call';
    protected $description = 'Command description';
    public function handle()
    {

        $vinDataCounter = VinDataCounter::first();

        if ($vinDataCounter->start <= $vinDataCounter->sn_total) {



            // start from 2300005005 to 2300005005 + 500
            for ($i = $vinDataCounter->start; $i <= ($vinDataCounter->start + $vinDataCounter->end); $i++) {
                $this->info('Processing number: ' . $i);

                $url = url('call/' . $i);
                // we will increase 2300001005


                $response = Http::withOptions([
                    'debug' => true,
                    'verify' => false,
                ])->get($url);

                // Optional: Print status code
                if ($response->successful()) {
                    $this->info('Request successful for ' . $i);
                } else {
                    $this->error('Request failed for ' . $i);
                }
            }

            VinDataCounter::where('id', 1)->update([
                'start' => $vinDataCounter->start + 500,
            ]);
            return 0;
        }
    }
}
