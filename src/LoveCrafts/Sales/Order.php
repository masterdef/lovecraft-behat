<?php

namespace LoveCrafts\Sales;

class Order
{
    /**
     * @var string
     */
    private $status = 'open';

    /**
     * @var array
     */
    private $items = array();

    /**
     * @var float
     */
    private $shippingCost = 4.50;

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

    /**
     * @return float
     */
    public function getShippingCost()
    {
        return $this->shippingCost;
    }

    /**
     * @return array
     */
    public function getItem($sku)
    {
      foreach ($this->items as $item) {
        if ($item['sku'] == $sku) return $item;
      }
    }

}
