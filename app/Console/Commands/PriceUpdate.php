<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;

use App\Registrar;

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
      $prices = Registrar::findOrFail(1)->prices();

      foreach ($prices as $price) {
        $domainZone = mb_strtolower($price->domain()->name);
        $domainName = ($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew';
        $domainName = $domainName . $domainZone;

        do {
          $domainPrice = $this->getDomainPrice($domainName);
        } while (!$domainPrice);

        $this->line($domainName . ' | ' . $domainPrice);
      }
    }

    public function getDomainPrice($domainName)
    {
      $client = new Client();

      $result = $client->request('POST', 'https://www.reg.ru/domain/new/check_queue', [
        'query' => [
          'ru' => 1,
          'domains' => $domainName,
        ]
      ])->getBody();

      return json_decode($result, true)['domains'][0]['price'] ?? null;
    }
}
