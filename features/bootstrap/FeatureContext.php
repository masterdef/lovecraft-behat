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
            // $row['sku'], $row['qty'], $row['price']
        }
        throw new PendingException();
    }

    /**
     * @Given the shipping cost is :arg1
     */
    public function theShippingCostIs($arg1)
    {
      return 4.50;
    }

    /**
     * @Then the subtotal is :arg1
     */
    public function theSubtotalIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the grand total is :arg1
     */
    public function theGrandTotalIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the number of items ordered is :arg1
     */
    public function theNumberOfItemsOrderedIs($arg1)
    {
        throw new PendingException();
    }


    /**
     * @When a discount of :arg1 is applied
     */
    public function aDiscountOfIsApplied($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the subtotal should be :arg1
     */
    public function theSubtotalShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the grand total should be :arg1
     */
    public function theGrandTotalShouldBe($arg1)
    {
        throw new PendingException();
    }

    /**
     * @When the following items are refunded:
     */
    public function theFollowingItemsAreRefunded(TableNode $table)
    {
        throw new PendingException();
    }

    /**
     * @Then the number of items refunded is :arg1
     */
    public function theNumberOfItemsRefundedIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the refunded amount is :arg1
     */
    public function theRefundedAmountIs($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then the shipping cost refunded is :arg1
     */
    public function theShippingCostRefundedIs($arg1)
    {
        throw new PendingException();
    }
}

