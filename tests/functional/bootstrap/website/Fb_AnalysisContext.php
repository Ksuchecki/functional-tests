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
use Facebook\WebDriver\Interactions\Internal\WebDriverCoordinates;
use Facebook\WebDriver\Interactions\Touch\WebDriverScrollAction;
use Facebook\WebDriver\Interactions\WebDriverActions;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriver;
use Facebook\WebDriver\WebDriverAction;
use Facebook\WebDriver\WebDriverBy;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\Interactions\Internal\WebDriverMouseAction;
use Facebook\WebDriver\WebDriverMouse;
use Facebook\WebDriver\Interactions\Touch\WebDriverTouchAction;


class Fb_AnalysisContext extends AbstractContext implements Context
{
    protected $url;
    protected $url_2;
    protected $css_1;
    protected $css_2;
    protected $css_3;
    protected $css_4;
    protected $css_5;
    protected $css_6;

    public function __construct($url, $url_2, $css_1, $css_2, $css_3, $css_4, $css_5, $css_6)
    {
        parent:: __construct();
        $this->url = $url;
        $this->url_2 = $url_2;
        $this->css_1 = $css_1;
        $this->css_2 = $css_2;
        $this->css_3 = $css_3;
        $this->css_4 = $css_4;
        $this->css_5 = $css_5;
        $this->css_6 = $css_6;
    }
    /**
     * @When /^I click on analysis tab$/
     */
    public function iClickOnAnalysisTab()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $this->driver->navigate()->to($this->url_2);
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
                $field = $this->driver->findElement(WebDriverBy::id($this->css_1))->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Given /^Find Facebook field$/
     */
    public function findFacebookField()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->getMouse()->mouseDown();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Given /^I click on checkbox$/
     */
    public function iClickOnCheckbox()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $element= $this->driver->findElement(WebDriverBy::xpath($this->css_6));
                $field = WebDriverActions::class->moveToElement($element);
                $element->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });$this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->findElement(WebDriverBy::id($this->css_3))->click();
                $field->isSelected();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
        $this->driver->wait(100, 300)->until(function () {
            try {
                $close= $this->driver->findElement(WebDriverBy::xpath($this->css_4))->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Then /^I should see mentions from Facebook$/
     */
    public function iShouldSeeMentionsFromFacebook()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $field = $this->driver->findElement(WebDriverBy::id($this->css_5));
                $field->isDisplayed();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }


}