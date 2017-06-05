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
class MentionsContext extends AbstractContext  implements Context
{

    protected $css_1;
    protected $css_2;
    protected $css_3;
    protected $url;
    protected $scope;



    /**
     * @return mixed
     */
    public function __construct($css_1,$css_2,$css_3,$url)
    {

        parent:: __construct();

        $this->css_1 = $css_1;
        $this->css_2 = $css_2;
        $this->css_3 = $css_3;
        $this->url = $url;

    }

    /**
     * @Given /^I click on Facebook mentions$/
     */
    public function iClickOnFacebookMentions()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $mentionsField=$this->driver->findElement(WebDriverBy::id($this->css_1));
                $mentionsField->isDisplayed();
                $mentionsField->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Then /^I see mentions from Facebook$/
     */
    public function iSeeMentionsFromFacebook()
    {

        $this->driver->wait(100, 300)->until(function () {
            try {
                $this->driver->findElement(WebDriverBy::className($this->css_2));
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });

        $this->driver->wait(100, 300)->until(function () {
            try {
                $this->driver->findElements(WebDriverBy::className($this->css_3));
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }
}

