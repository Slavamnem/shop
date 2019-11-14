<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.11.2019
 * Time: 0:57
 */

namespace App\Adapters;

use App\Share;

class ShareConditionsAdapter
{
    /**
     * @var Share
     */
    private $share;

    /**
     * ShareConditionsAdapter constructor.
     * @param Share $share
     */
    public function __construct(Share $share)
    {
        $this->share = $share;
    }
}
