<?php

namespace App\Http\Controllers\Admin;

use App\Services\TranslatorService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
