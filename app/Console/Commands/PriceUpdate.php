<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

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
      // REG
      //------------------------------------------------------------------------
      // $prices = Registrar::findOrFail(1)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //   $method = 'POST';
      //   $registarRequest = 'https://www.reg.ru/domain/new/check_queue';
      //   $registarRequestQuery = [
      //     'ru' => 1,
      //     'domains' => $domainName,
      //   ];
      //
      //   do {
      //     $domainPrice = $this->getDomainPrice($method, $registarRequest, $registarRequestQuery)['domains'][0]['price'] ?? null;
      //   } while (!$domainPrice);
      //
      //   if ($domainPrice != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $domainPrice . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------

      // RUcenter
      //------------------------------------------------------------------------
      // $prices = Registrar::findOrFail(2)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //   $method = 'POST';
      //   $registarRequest = 'https://www.nic.ru/app/v1/get/services';
      //   $registarRequestQuery = [
      //     'lang' => 'ru',
      //     'limit' => 1,
      //     'offset' => 0,
      //     'search' => $domainName,
      //     'url' => 'domains',
      //   ];
      //
      //   do {
      //     $domainPrice = $this->getDomainPrice($method, $registarRequest, $registarRequestQuery)['body']['services'][0]['prices'][0]['cost']['value'] ?? null;
      //   } while (!$domainPrice);
      //
      //   if ($domainPrice != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $domainPrice . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------

      // .masterhost
      //------------------------------------------------------------------------
      // $method = 'POST';
      // $registarRequest = 'https://masterhost.ru/rs/products/list.json';
      // $registarRequestQuery = null;
      //
      // do {
      //   $products = $this->getDomainPrice($method, $registarRequest, $registarRequestQuery)['products'] ?? null;
      // } while (!$products);
      //
      // foreach ($products as $product) {
      //   if ($product['category'] != 'domain') continue;
      //
      //   $domain = '.' . $product['properties'][0]['value'];
      //   $price = (int) $product['unitPrice'];
      //
      //   $registrarMasterhostPrices[$domain] = $price;
      // }
      //
      // $prices = Registrar::findOrFail(3)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //
      //   if ($registrarMasterhostPrices[$domainZone] != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $registrarMasterhostPrices[$domainZone] . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------

      // GoDaddy
      //------------------------------------------------------------------------
      // $prices = Registrar::findOrFail(5)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //   $method = 'GET';
      //   $registarRequest = 'https://ru.godaddy.com/domainsapi/v1/search/exact';
      //   $registarRequestQuery = [
      //     'q' => $domainName,
      //   ];
      //
      //   do {
      //     $domainPrice = (int) $this->getDomainPrice($method, $registarRequest, $registarRequestQuery)['Products'][0]['PriceInfo']['CurrentPrice'];
      //   } while (!$domainPrice);
      //
      //   if ($domainPrice != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $domainPrice . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------

      // HOSTINGER
      //------------------------------------------------------------------------
      $method = 'POST';
      $registarRequest = 'https://www.hostinger.ru/domain-search';
      $registarRequestQuery = [
        'q' => 'parcedomainprice',
      ];

      do {
        $domains = $this->getDomainPrice($method, $registarRequest, $registarRequestQuery) ?? null;
      } while (!$domains);

      foreach ($domains as $domain) {

        $tld = $domain['product']['config']['tld'];
        $price = (int) $domain['product']['billing']['price'];

        $registrarHostingerPrices[$tld] = $price;
      }

      $prices = Registrar::findOrFail(6)->prices()->get();

      foreach ($prices as $price) {
        $tld =  mb_strtolower($price->domain->name);

        if ($registrarHostingerPrices[$tld] != $price->price) {
          $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $tld . ' | NEW: ' . $registrarHostingerPrices[$tld] . ' | OLD: ' . $price->price);
        }
      }
      //------------------------------------------------------------------------

      // ДЖИНО
      //------------------------------------------------------------------------
      // $html = file_get_contents('https://domains.jino.ru/price/');
      //
      // $crawler = new Crawler($html);
      //
      // $nodeValues = $crawler->filter('#domains-price > li')->each(function (Crawler $node) {
      //   return $node;
      // });
      //
      // foreach ($nodeValues as $value) {
      //   $domain = '.' . substr($value->filter('a > h3')->text(), 4);
      //   $price = $value->filter('a > div.domains-price-prices > div.domains-price-regprice > span > span.rub-value')->text();
      //
      //   $registrarJinoPrices[$domain] = $price;
      // }
      //
      // $prices = Registrar::findOrFail(7)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //
      //   if ($registrarJinoPrices[$domainZone] != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $registrarJinoPrices[$domainZone] . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------

      // FOZZY
      //------------------------------------------------------------------------
      // $prices = Registrar::findOrFail(8)->prices()->get();
      //
      // foreach ($prices as $price) {
      //   $domainZone =  mb_strtolower($price->domain->name);
      //   $domainName = (($domainZone == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $domainZone;
      //   $method = 'GET';
      //   $registarRequest = 'https://accounts.fozzy.com/tools/api/prices/domains/' . $domainName;
      //   $registarRequestQuery = [
      //     'locale' => 'ru',
      //     'actiontype' => 'register',
      //     'currency' => 'rub',
      //   ];
      //
      //   do {
      //     $domainPrice = (int) $this->getDomainPrice($method, $registarRequest, $registarRequestQuery)['data']['attributes']['prices'][0]['price'];
      //   } while (!$domainPrice);
      //
      //   if ($domainPrice != $price->price) {
      //     $this->info('| Регистратор: ' . $price->registrar->name . ' | Домен: ' . $domainZone . ' | NEW: ' . $domainPrice . ' | OLD: ' . $price->price);
      //   }
      // }
      //------------------------------------------------------------------------
    }


    public function getDomainPrice($method, $registarRequest, $registarRequestQuery)
    {
      $client = new Client();

      $result = $client->request($method, $registarRequest, [
        'form_params' => $registarRequestQuery,
      ])->getBody();

      return json_decode($result, true);
    }
}
