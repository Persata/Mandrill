<?php

namespace Persata\Mandrill\Model;

use Persata\Mandrill\Helper\Data;

class Api extends \Mandrill
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * @param Data $helper
     */
    public function __construct(
        Data $helper
    )
    {
        parent::__construct($helper->getApiKey());
    }
}