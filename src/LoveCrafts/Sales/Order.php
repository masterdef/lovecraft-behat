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
     * @var array
     */
    private $refundedItems = array();

    /**
     * @var float
     */
    private $shippingCost = 4.50;

    /**
     * @var float
     */
    private $refundedShippingCost = 0;

    /**
     * @var float
     */
    private $discount = 0;

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @param string $status
     */
    public function setShippingCost($shippingCost)
    {
        $this->shippingCost = $shippingCost;
    }

    /**
     * @param float $shippingCost
     */
    public function setRefundedShippingCost($shippingCost)
    {
        $this->refundedShippingCost = $shippingCost;
    }

    /**
     * @return float
     */
    public function getRefundedShippingCost()
    {
        return $this->refundedShippingCost;
    }

    /**
     * @param float $discount
     */
    public function applyDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return float
     */
    public function getDiscount()
    {
      return (float)$this->discount;
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
      $subtotal = -($this->getDiscount());
      foreach ($this->getItems() as $item) {
        $subtotal += $item['qty'] * $item['unit_price'];
      }

      return $subtotal;
    }

    /**
     * @return int
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
     * @return int
     */
    public function getRefundedNumberOfItems()
    {
      $numberOfItems = 0;
      foreach ($this->getRefundedItems() as $item) {
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
    public function getRefundedItems()
    {
      return $this->refundedItems;
    }

    /**
     * @return bool
     */
    public function isOrderRefunded()
    {
      if (($this->getGrandTotal() + $this->getRefundedShippingCost()) == $this->getRefundedAmount()) return true;
      return false;
    }


    /**
     * Set order status refunded
     **/
    public function refundOrder() {
      $this->setShippingCost('refunded');
      $this->setStatus('refunded');
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

    /**
     * @param array $item
     */
    public function refund($item)
    {
      $this->refundedItems[] = $item;
      $this->setStatus('partially_refunded');

    }

    /**
     * @return float
     */
    public function getRefundedAmount()
    {
      $refundedAmount = 0;
      foreach ($this->getRefundedItems() as $item) {
        $orderItem = $this->getItem($item['sku']);
        $refundedAmount += $item['qty'] * $orderItem['unit_price'];
      }

      return $refundedAmount + $this->getRefundedShippingCost();
    }

    /**
     * Refund shipping cost
     */
    public function refundShipping()
    {
      $this->setRefundedShippingCost($this->getShippingCost());
      $this->setShippingCost('refunded');

      if ($this->isOrderRefunded()) $this->refundOrder();
    }

}
