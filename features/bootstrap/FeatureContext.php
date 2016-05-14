<?php

require_once __DIR__ . '/../../vendor/autoload.php';

use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;

use LoveCrafts\Sales\Order;

/**
 * Defines application features from the specific context.
 */
class FeatureContext implements Context, SnippetAcceptingContext
{
    /** @var Order */
    private $order;

    /**
     * @Given /^a new order is created$/
     */
    public function aNewOrderIsCreated()
    {
        $this->order = new Order();
        
        $this->order->addItem(array(
          'sku' => 'SKU1',
          'qty' => 2,
          'unit_price' => 9.50
        ));
        $this->order->addItem(array(
          'sku' => 'SKU2',
          'qty' => 1,
          'unit_price' => 20.50
        ));
        $this->order->addItem(array(
          'sku' => 'SKU3',
          'qty' => 5,
          'unit_price' => 1.00
        ));
    }

    /**
     * @When /^I set the status to (\w+)$/
     */
    public function iSetTheStatusTo($status)
    {
        $this->order->setStatus($status);
    }

    /**
     * @Then /^the status is (\w+)$/
     *
     * @param string $status
     * @return bool
     * @throws Exception
     */
    public function theStatusIs($status)
    {
        if ($this->order->getStatus() != $status) {
            throw new \Exception(sprintf(
                'Expected status %s to be %s.',
                $this->order->getStatus(),
                $status
            ));
        }
    }

    /**
     * @Given /^the order has the following items:$/
     * @param TableNode $table
     */
    public function theOrderHasTheFollowingItems(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            // $row['sku'], $row['qty'], $row['unit_price']
            if ($item = $this->order->getItem($row['sku'])) {
              if (!is_array($item)) 
                throw new \Exception(sprintf('Item %s do not found in order.', $row['sku']));
              if ($item['sku'] != $row['sku']) 
                throw new \Exception(sprintf('Item SKU %s to be %s.', $item['sku'], $row['sku']));
              if ($item['qty'] != $row['qty']) 
                throw new \Exception(sprintf('Item QTY %s to be %s.', $item['qty'], $row['qty']));
              if ($item['unit_price'] != $row['unit_price']) 
                throw new \Exception(sprintf('Item UnitPrice %s to be %s.', $item['unit_price'], $row['unit_price']));
            }
        }
    }

    /**
     * @Given the shipping cost is :arg1
     */
    public function theShippingCostIs($cost)
    {
      if ($cost == 'refunded') $this->order->refundShipping();
      else $this->order->setShippingCost($cost);
    }


    /**
     * @Then the subtotal is :arg1
     */
    public function theSubtotalIs($subtotal)
    {
        if ($this->order->getSubtotal() != $subtotal) {
          throw new \Exception(sprintf(
            'Expected subtotal is %s.',
            $this->order->getSubtotal()
          ));
        }
    }

    /**
     * @Then the grand total is :total
     */
    public function theGrandTotalIs($total)
    {
        if ($this->order->getGrandTotal() != $total) {
          throw new \Exception(sprintf(
            'Expected Grand Total is %s.',
            $this->order->getGrandTotal()
          ));
        }
    }

    /**
     * @Then the number of items ordered is :arg1
     */
    public function theNumberOfItemsOrderedIs($numberOfItems)
    {
        if ($this->order->getNumberOfItems() != $numberOfItems) {
          throw new \Exception(sprintf(
            'Expected Number of Items is %s.',
            $this->order->getNumberOfItems()
          ));
        }
    }


    /**
     * @When a discount of :arg1 is applied
     */
    public function aDiscountOfIsApplied($arg1)
    {
        $this->order->applyDiscount(12.50);
        //throw new PendingException();
    }

    /**
     * @Then the subtotal should be :arg1
     */
    public function theSubtotalShouldBe($subtotal)
    {
        if ($this->order->getSubtotal() != $subtotal) {
          throw new \Exception(sprintf(
            'Expected subtotal %s is %s.',
            $subtotal,
            $this->order->getSubtotal()
          ));
        }
    }

    /**
     * @Then the grand total should be :arg1
     */
    public function theGrandTotalShouldBe($total)
    {
        if ($this->order->getGrandTotal() != $total) {
          throw new \Exception(sprintf(
            'Expected Grand Total is %s.',
            $this->order->getGrandTotal()
          ));
        }
    }

    /**
     * @When the following items are refunded:
     */
    public function theFollowingItemsAreRefunded(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) {
            // $row['sku'], $row['qty']
            $this->order->refund($row);
        }
    }

    /**
     * @Then the number of items refunded is :arg1
     */
    public function theNumberOfItemsRefundedIs($numberOfItems)
    {
        if ($this->order->getRefundedNumberOfItems() != $numberOfItems) {
          throw new \Exception(sprintf(
            'Refunded Number of Items is %s.',
            $this->order->getRefundedNumberOfItems()
          ));
        }
    } //endfunction

    /**
     * @Then the refunded amount is :arg1
     */
    public function theRefundedAmountIs($refundedAmount)
    {
        if ($this->order->getRefundedAmount() != $refundedAmount) {
          throw new \Exception(sprintf(
            'Expected Refunded Amount is %s.',
            $this->order->getRefundedAmount()
          ));
        }
    }

    /**
     * @Then the shipping cost refunded is :arg1
     */
    public function theShippingCostRefundedIs($cost)
    {
        if ($this->order->getRefundedShippingCost() != $cost) {
          throw new \Exception(sprintf(
            'Expected refunded shipping cost %s is %s.',
            $cost,
            $this->order->getShippingCost()
          ));
        }
    }

    /**
     * @When action the shipping cost is refunded
     */
    public function actionTheShippingCostIsRefunded()
    {
        $this->order->refundShipping();
    }

    /**
     * @When the action shipping cost is refunded
     */
    public function theActionShippingCostIsRefunded()
    {
        $this->order->refundShipping();
    }
}

