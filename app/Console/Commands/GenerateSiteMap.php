<?php

namespace App\Console\Commands;

use App\Builders\XmlDocumentBuilder;
use App\Product;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;

class GenerateSiteMap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var
     */
    private $xmlDocBuilder;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->xmlDocBuilder = new XmlDocumentBuilder();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->xmlDocBuilder->createDocument(config('sitemap.file-name'));

        foreach ($this->getSitePages() as $key => $item) {
            $this->xmlDocBuilder->addRow($item, 'item');
        }

        $this->xmlDocBuilder->saveDocument();
    }

    /**
     * @return array
     */
    private function getSitePages()
    {
        $pages = collect();

        $pages->put('main', $this->getPageStructure(env('APP_URL')));
        $pages->put('poster', $this->getPageStructure(env('APP_URL') . '/poster'));
        $pages->put('tracks', $this->getPageStructure(env('APP_URL') . '/tracks'));
        $pages->put('clips', $this->getPageStructure(env('APP_URL') . '/clips'));
        $pages->put('contacts', $this->getPageStructure(env('APP_URL') . '/contacts'));
        $pages->put('checkout', $this->getPageStructure(env('APP_URL') . '/order/checkout'));

        $this->addProductPages($pages);

        return $pages->toArray();
    }

    /**
     * @param $pages
     */
    private function addProductPages($pages)
    {
        foreach (Product::all() as $product) {
            $pages->put($product->id, $this->getPageStructure(env('APP_URL') . '/product/' . $product->getFullSlug()));
        }
    }

    /**
     * @param $pageLink
     * @param $pageType
     * @return array
     */
    private function getPageStructure($pageLink, $pageType = 1)
    {
        return [
            'link' => $pageLink,
            'priority' => 1, //TODO
            'lastmod' => '2019'
        ];
    }
}
