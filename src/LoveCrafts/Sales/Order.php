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
    public function getGrandTotal()
    {
      return ($this->getShippingCost() + $this->getSubtotal());
    }

    /**
     * @return float
     */
    public function getSubtotal()
    {
      $subtotal = 0;
      foreach ($this->getItems() as $item) {
        $subtotal += $item['qty'] * $item['unit_price'];
      }

      return $subtotal;
    }

    /**
     * @return float
     */
    public function getNumberOfItems()
    {
      $numberOfItems = 0;
      foreach ($this->getItems() as $item) {
        $numberOfItems += $item['qty'];
      }

      return $numberOfItems;
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
    public function getItems()
    {
      return $this->items;
    }

    /**
     * @param array $item
     */
    public function addItem($item)
    {
      $this->items[] = $item;
    }

    /**
     * @return array
     */
    public function getItem($sku)
    {
      foreach ($this->getItems() as $item) {
        if ($item['sku'] == $sku) return $item;
      }
    }

}
