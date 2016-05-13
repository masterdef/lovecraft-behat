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
}
