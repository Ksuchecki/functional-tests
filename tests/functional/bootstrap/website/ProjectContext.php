<?php
namespace B24\Tests\Functional\bootstrap\website;
use behat;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\MinkExtension;
use Behat\Testwork\Tester\Result\TestResult;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\RemoteWebElement;
use Facebook\WebDriver\WebDriverBy;
use Behat\MinkExtension\Context\MinkContext;
use Facebook\WebDriver\Exception\NoSuchElementException;
class ProjectContext extends AbstractContext  implements Context
{
    protected $css_1;
    protected $css_2;
    protected $text;
    protected $url;
    protected $scope;
    /**
     * @return mixed @config
     */
    public function __construct($css_1, $url, $text, $css_2)
    {
        parent::__construct();
        $this->css_1 = $css_1;
        $this->url = $url;
        $this->text = $text;
        $this->css_2 = $css_2;
    }

    /**
     * @Given /^Change project name at "([^"]*)"$/
     */
    public function changeProjectNameAt($newName)
    {
        $projectName = $this->driver->findElement(WebDriverBy::id($this->css_1));
        $projectName->clear();
        $projectName->sendKeys($newName);

    }

    /**
     * @Given /^Click save$/
     */
    public function clickSave()
    {

        $this->driver->wait(100, 300)->until(function () {
            try {
                /** @var RemoteWebElement ss$submit */
                $submit = $this->driver->findElement(WebDriverBy::partialLinkText($this->text));
                $submit->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
        });
    }

    /**
     * @Then /^I am in my project$/
     */
    public function iAmInMyProject()
    {
        $this->driver->wait(100, 300)->until(function () {
        try {
            /** @var \Facebook\WebDriver\Remote\RemoteWebElement $element */
            $element = $this->driver->findElement(WebDriverBy::id($this->css_2));
            $element->isDisplayed();
            return true;
        } catch (NoSuchElementException $ex) {
            return false;
        }
    });
    }


}