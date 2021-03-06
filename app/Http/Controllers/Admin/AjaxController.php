<?php

namespace App\Http\Controllers\Admin;

use App\Product;
use App\Services\Admin\OrderService;
use App\Services\Admin\ProductService;
use App\Services\TranslatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class AjaxController extends Controller
{
    /**
     * @var
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @return string
     */
    public function getTranslation()
    {
        return TranslatorService::translate($this->request->get('value'));
    }
}
