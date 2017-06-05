<?php
namespace B24\Tests\Functional\bootstrap\website;
use behat;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Mink\Selector\Xpath\Escaper;
use Behat\MinkExtension;
use Behat\Testwork\Tester\Result\TestResult;
use Facebook\WebDriver\Exception\NoSuchElementException;
use Facebook\WebDriver\Interactions\WebDriverActions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\WebDriverElement;
class AnalysisContext extends AbstractContext implements Context
{
    protected $url;
    protected $url2;
    protected $word;
    protected $css1;
    protected $css2;
    protected $css3;
    protected $css4;

    public function __construct($word, $url, $url_2, $cssFiltersButton, $cssFilterInput, $cssSearchButton, $cssCloseTab)
    {
        parent:: __construct();
        $this->url = $url;
        $this->url2 = $url_2;
        $this->word = $word;
        $this->css1 = $cssFiltersButton;
        $this->css2 = $cssFilterInput;
        $this->css3 = $cssSearchButton;
        $this->css4 = $cssCloseTab;
    }

    /**
     * @When /^I click on analysis tab$/
     */
    public function iClickOnAnalysisTab()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $this->driver->navigate()->to($this->url2);
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Given /^I click on filter mentions$/
     */
    public function iClickOnFilterMentions()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->findElement(WebDriverBy::id($this->css1))->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Given /^Find and fill field$/
     */
    public function findAndFillField()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->findElement(WebDriverBy::id($this->css2))->sendKeys($this->word);
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Given /^I click search button$/
     */
    public function iClickSearchButton()
    {

        $this->driver->wait(100, 300)->until(function () {
            try {
                $search= $this->driver->findElement(WebDriverBy::className($this->css3))->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
        $this->driver->wait(100, 300)->until(function () {
            try {
                $close= $this->driver->findElement(WebDriverBy::xpath($this->css4))->click();
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
                $findPhrese=$this->driver->findElement(WebDriverBy::partialLinkText($this->word));
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }



}