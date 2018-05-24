<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

use App\Domain;
use App\Price;
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

      private $pricesUpdate = [];

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
      $this->reg();
      $this->rucenter();
      $this->masterhost();
      $this->timeweb();
      $this->goDaddy();
      $this->hostinger();
      $this->jino();
      $this->fozzy();

      $this->_output();
    }
      // REG
      //------------------------------------------------------------------------
        private function reg()
        {

        $prices = Registrar::findOrFail(1)->prices()->get();

        foreach ($prices as $price) {
          $tld = mb_strtolower($price->domain->name);
          $tldName = (($tld == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $tld;

          $method = 'POST';
          $uri = 'https://www.reg.ru/domain/new/check_queue';
          $type = 'query';
          $query = [
            'ru' => 1,
            'domains' => $tldName,
          ];

          do {
            $priceExt = $this->_getDomainPrice($method, $uri, $type, $query)['domains'][0]['price'] ?? null;
          } while (!$priceExt);

          $this->_setPriceUpdate($priceExt, $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // RUcenter
      //------------------------------------------------------------------------
      private function rucenter()
      {
        $prices = Registrar::findOrFail(2)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);
          $tldName = (($tld == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $tld;

          $method = 'POST';
          $uri = 'https://www.nic.ru/app/v1/get/services';
          $type = 'query';
          $query = [
            'lang' => 'ru',
            'limit' => 1,
            'offset' => 0,
            'search' => $tldName,
            'url' => 'domains',
          ];

          do {
            $priceExt = $this->_getDomainPrice($method, $uri, $type, $query)['body']['services'][0]['prices'][0]['cost']['value'] ?? null;
          } while (!$priceExt);

          $this->_setPriceUpdate($priceExt, $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // .masterhost
      //------------------------------------------------------------------------
      private function masterhost()
      {
        $method = 'POST';
        $uri = 'https://masterhost.ru/rs/products/list.json';
        $type = 'query';
        $query = null;

        do {
          $domainsExt = $this->_getDomainPrice($method, $uri, $type, $query)['products'] ?? null;
        } while (!$domainsExt);

        foreach ($domainsExt as $domainExt) {
          if ($domainExt['category'] != 'domain')
            continue;

          $tldExt = '.' . $domainExt['properties'][0]['value'];
          $priceExt = (int) $domainExt['unitPrice'];

          $pricesExt[$tldExt] = $priceExt;
        }

        $prices = Registrar::findOrFail(3)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);

          $this->_setPriceUpdate($pricesExt[$tld], $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // timeweb
      //------------------------------------------------------------------------
      private function timeweb()
      {
        $html = file_get_contents('https://timeweb.com/ru/services/domains/');

        preg_match('/var arDomains=(.*);var arDomainList/', $html, $matches);

        $domainsExt = json_decode($matches[1],  true);

        foreach ($domainsExt as $node) {
          foreach ($node as $domainsExt) {
            $tldExt = '.' . $domainsExt['name'];
            $priceExt = $domainsExt['price'];

            $pricesExt[$tldExt] = $priceExt;
          }
        }

        $prices = Registrar::findOrFail(4)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);

          $this->_setPriceUpdate($pricesExt[$tld], $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // GoDaddy
      //------------------------------------------------------------------------
      private function goDaddy()
      {
        $prices = Registrar::findOrFail(5)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);
          $tldName = (($tld == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $tld;

          $method = 'GET';
          $uri = 'https://ru.godaddy.com/domainsapi/v1/search/exact';
          $type = 'query';
          $query = [
            'q' => $tldName,
          ];

          do {
            $priceExt = (int) $this->_getDomainPrice($method, $uri, $type, $query)['Products'][0]['PriceInfo']['CurrentPrice'];
          } while (!$priceExt);

          $this->_setPriceUpdate($priceExt, $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // HOSTINGER
      //------------------------------------------------------------------------
      private function hostinger()
      {
        $method = 'POST';
        $uri = 'https://www.hostinger.ru/domain-search';
        $type = 'form_params';
        $query = [
          'q' => 'parcedomainprice',
        ];

        do {
          $domainsExt = $this->_getDomainPrice($method, $uri, $type, $query) ?? null;
        } while (!$domainsExt);

        foreach ($domainsExt as $domainExt) {
          $tldExt = $domainExt['product']['config']['tld'];
          $priceExt = (int) $domainExt['product']['billing']['price'];

          $pricesExt[$tldExt] = $priceExt;
        }

        $prices = Registrar::findOrFail(6)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);

          $this->_setPriceUpdate($pricesExt[$tld], $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // ДЖИНО
      //------------------------------------------------------------------------
      private function jino()
      {
        $html = file_get_contents('https://domains.jino.ru/price/');

        $crawler = new Crawler($html);

        $nodes = $crawler->filter('#domains-price > li')->each(function (Crawler $node) {
          return $node;
        });

        foreach ($nodes as $node) {
          $tldExt = '.' . substr($node->filter('a > h3')->text(), 4);
          $priceExt = $node->filter('a > div.domains-price-prices > div.domains-price-regprice > span > span.rub-value')->text();

          $pricesExt[$tldExt] = $priceExt;
        }

        $prices = Registrar::findOrFail(7)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);
          $tldName = (($tld == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $tld;

          $this->_setPriceUpdate($pricesExt[$tld], $price, $tld);
        }
      }
      //------------------------------------------------------------------------

      // FOZZY
      //------------------------------------------------------------------------
      private function fozzy()
      {
        $prices = Registrar::findOrFail(8)->prices()->get();

        foreach ($prices as $price) {
          $tld =  mb_strtolower($price->domain->name);
          $tldName = (($tld == '.рф') ? 'парсингдоменценац' : 'parcedomainpricew') . $tld;

          $method = 'GET';
          $uri = 'https://accounts.fozzy.com/tools/api/prices/domains/' . $tldName;
          $type = 'query';
          $query = [
            'locale' => 'ru',
            'actiontype' => 'register',
            'currency' => 'rub',
          ];

          do {
            $priceExt = (int) $this->_getDomainPrice($method, $uri, $type, $query)['data']['attributes']['prices'][0]['price'];
          } while (!$priceExt);

          $this->_setPriceUpdate($priceExt, $price, $tld);
        }
      }
      //------------------------------------------------------------------------


    private function _getDomainPrice($method, $uri, $type, $query)
    {
      $client = new Client();

      $result = $client->request($method, $uri, [
        $type => $query,
      ])->getBody();

      return json_decode($result, true);
    }

    private function _setPriceUpdate($priceExt, $price, $tld)
    {
      if ($priceExt != $price->price) {
        $this->pricesUpdate[] = [
          'registrar' => $price->registrar->name,
          'domain' => $tld,
          'new' => $priceExt,
          'old' => $price->price,
          'difference' => $priceExt - $price->price,
        ];
      }
    }

    private function _output()
    {
      if ($this->pricesUpdate) {
        $headers = ['Регистратор', 'Домен', 'Новая', 'Старая', 'Разница'];

        $this->table($headers, $this->pricesUpdate);

        $this->_update();
      } else {
        $this->line('Нет цен для обновления.');
      }
    }

    private function _update()
    {
      if ($this->confirm('Обновить цены?')) {

        foreach ($this->pricesUpdate as $priceUpdate) {
          $domain = Domain::where('name', $priceUpdate['domain'])->first();
          $registrar = Registrar::where('name', $priceUpdate['registrar'])->first();

          Price::where('domain_id', $domain->id)->where('registrar_id', $registrar->id)->update(['price' => $priceUpdate['new']]);
        }
      }
    }
}
