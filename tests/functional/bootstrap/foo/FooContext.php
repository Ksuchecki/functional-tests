<?php
namespace B24\Tests\Functional\bootstrap\foo;

use Behat\Behat\Context\Context;

final class FooContext implements Context
{
    protected $applepen;

    protected $apple;

    protected $pen;

    /**
     * @Given I have an apple
     */
    public function iHaveAnApple()
    {
        $this->apple = true;
    }

    /**
     * @Given I have a pen
     */
    public function iHaveAPen()
    {
        $this->pen = true;
    }

    /**
     * @When Uhh
     */
    public function uhh()
    {
        $this->applepen = ($this->apple && $this->pen);
    }

    /**
     * @Then Applepen
     */
    public function applepen()
    {
        \PHPUnit_Framework_Assert::assertSame(true, $this->applepen);
    }

}