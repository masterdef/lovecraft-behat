Feature: Sales Orders

  Background:
    Given a new order is created
    And the order has the following items:
      | sku  | qty | unit_price |
      | SKU1 | 2   | 9.50       |
      | SKU2 | 1   | 20.50      |
      | SKU3 | 5   | 1.00       |
    And the shipping cost is 4.50

  Scenario: Status is changed
    When I set the status to processing
    Then the status is processing

  Scenario: New order is created
    Then the status is open
    And the subtotal is 44.50
    And the grand total is 49.00
    And the number of items ordered is 8

  # DISCOUNTS

  Scenario: An order is discounted
    When a discount of 12.50 is applied
    Then the subtotal should be 32.00
    And the grand total should be 36.50

  # REFUNDS

  Scenario: Order is partially refunded
    When the following items are refunded:
      | sku  | qty |
      | SKU2 | 1   |
    Then the number of items refunded is 1
    And the status is partially_refunded
    And the refunded amount is 20.50

  Scenario: All order items are refunded
    When the following items are refunded:
      | sku  | qty |
      | SKU1 | 2   |
      | SKU2 | 1   |
      | SKU3 | 5   |
    Then the number of items refunded is 8
    And the status is partially_refunded
    And the refunded amount is 44.50

  Scenario: Shipment cost is refunded
    When the shipping cost is refunded
    Then the shipping cost refunded is 4.50
    And the refunded amount is 4.50

  Scenario: Shipment cost is refunded
    When the shipping cost is refunded
    And the following items are refunded:
      | sku  | qty |
      | SKU2 | 1   |
    Then the shipping cost refunded is 4.50
    And the refunded amount is 25.00

  Scenario: Full order is refunded
    When the following items are refunded:
      | sku  | qty |
      | SKU1 | 2   |
      | SKU2 | 1   |
      | SKU3 | 5   |
    And the shipping cost is refunded
    Then the number of items refunded is 8
    And the status is refunded
    And the refunded amount is 49.00

