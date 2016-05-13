<?php

namespace LoveCrafts\Sales;

class Order
{
    /**
     * @var string
     */
    private $status = 'open';

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }
}
