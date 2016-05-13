# LoveCrafts Coding Test for eCommerce Roles

Congratulations, you have passed the first hurdles of our recruitment process. We, the software developers at LoveCrafts, have a simple rule: no code, no hire! In other words, we want to see you coding.

This coding test relies on [Behat](http://docs.behat.org/en/v3.0/), the Behaviour-Driven Development (BDD) suite for PHP. Don't be nervous if you have no experience with it. Here we only use the very basic features of Behat, which you can learn in the Quick Intro guide.

This test covers the following:
- setting up composer
- understanding test scenarios
- writing step definitions for those with a little bit of RegExp (life is not all guns and roses)
- modelling classes
- completing missing business logic
- demonstrating knowledge of eCommerce concepts

## Objective

Your objective is to make the tests pass. In the end, there should be no undefined or skipped steps left. The output should show the following:

    10 Scenarios (10 passed)
    67 Steps (67 passed)

## Steps to follow

1. Create a new Git repository in this folder.
2. Run `composer install`.
3. Run `bin/behat`. You should see that there are undefined and skipped 
steps.
4. Fix those so that there are no undefined and skipped steps left. 
5. Repeat 3 to verify that tests pass.

## How to Submit

1. Ensure changes are committed.
2. Remove `vendor` folder.
3. Zip this folder (ensure .git is included).
4. Reply to the coding test email sent by LoveCrafts with the zip file as attachment.