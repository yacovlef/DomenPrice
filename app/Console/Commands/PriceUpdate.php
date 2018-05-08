<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;

use App\Domain;

class PriceUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'price:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление цен';

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
      $client = new Client();

      $result = $client->request('POST', 'https://www.reg.ru/domain/new/check_queue', [
        'query' => [
          'ru' => 1,
          'domains' => 'parsedomainprice.com',
        ]
      ])->getBody();

      $this->line(json_decode($result, true)['domains'][0]['price']);
    }
}
