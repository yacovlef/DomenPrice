<?php

namespace App\Console\Commands\Registrar;

use Illuminate\Console\Command;

use Symfony\Component\DomCrawler\Crawler;

class Reg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registrar:reg';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Обновление цен по регистратору REG';

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
      $link = 'https://www.reg.ru/domain/new/';

      $html = file_get_contents($link);

      $crawler = new Crawler($html);

      $domains = $crawler->filter('#registration > div.b-page__content-wrapper.b-page__content-wrapper_style_indent.l-margin_bottom-normal.b-domain-form__tlds > div.b-tabs.b-tabs_size_medium.b-tabs_type_horizontal.b-tabs_color_default.b-tabs_style_title-line > div.b-tabs__content > div.b-tabs__item-content.b-tabs__item-content_state_current > div > dl > dd > div > div > ul > li')
      ->each(function (Crawler $node) {
        return $node;
      });

      foreach ($domains as $domain) {
        $name = $domain->filter('label > span.b-table-tlds__name-wrapper > span > span > span.b-checkbox__name')->text();
        $price = $domain->filter('label > span.b-table-tlds__price-wrapper')->text();

        $this->line('|' . $name . '|' . $price . '|');
      }

    }

}
