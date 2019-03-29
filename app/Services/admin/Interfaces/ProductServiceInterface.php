<?php

namespace App\Services\Admin\Interfaces;

use Illuminate\Http\Request;

interface ProductServiceInterface
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $groupId
     * @return \Illuminate\Http\Response
     */
    public function createModifications(Request $request, $groupId);
}