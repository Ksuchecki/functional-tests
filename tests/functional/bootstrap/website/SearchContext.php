<?php
namespace B24\Tests\Functional\bootstrap\website;
use behat;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\MinkExtension;
use Behat\Testwork\Tester\Result\TestResult;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\WebDriverElement;
class SearchContext extends AbstractContext implements Context
{
    protected $css_1;
    protected $css_2;
    protected $css_3;
    protected $word;
    protected $url;
    protected $scope;

    /**
     * @return mixed
     */
    public function __construct($word, $url, $css_1, $css_2, $css_3)
    {
        parent:: __construct();

        $this->word = $word;
        $this->url = $url;
        $this->css_1 = $css_1;
        $this->css_2 = $css_2;
        $this->css_3 = $css_3;
    }

    /**
     * @Given /^Find and fill search field$/
     */
    public function findAndFillSearchField()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->findElement(WebDriverBy::id($this->css_1))->sendKeys($this->word);
                $click= $this->driver->findElement(WebDriverBy::className($this->css_2))->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }



    /**
     * @Then /^I should see mentions with our phrese$/
     */
    public function iShouldSeeMentionsWithOurPhrese()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $findPhrese=$this->driver->findElement(WebDriverBy::className($this->css_3));
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }


}