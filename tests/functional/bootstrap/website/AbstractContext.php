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


class AbstractContext extends MinkContext implements Context
{
    protected $page;
    protected $driver;
    protected $url;
    protected $login;
    protected $password;
    /**
     * @return mixed
     */
    public function __construct($url = "https://brand24.pl/konto/logowanie/",
                                $login = "alebardzoprosze@brand24.pl",
                                $password = 'qwe123')
    {

        $host = 'http://localhost:4444/wd/hub';
        $capabilities = DesiredCapabilities::chrome();
        $this->driver = RemoteWebDriver::create($host, $capabilities, 5000);
        $this->login=$login;
        $this->password=$password;
        $this->url=$url;

    }
    /**
     * @Given /^Im logged in$/
     */
    public function imLoggedIn()
    {

        $this->driver->get($this->url);

        $this->driver->wait(100, 300)->until(function () {
            try {

                $loginField = $this->driver->findElement(WebDriverBy::id('login'));
                $loginField ->sendKeys($this->login);
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
            });


        $this->driver->wait(100, 300)->until(function () {
            try {
                $passField =  $this->driver->findElement(WebDriverBy::id('password'));
                $passField->sendKeys($this->password);
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }
            });


        $this->driver->wait(100, 300)->until(function () {
            try {

                $submit =   $this->driver->findElement(WebDriverBy::id('login_button'));
                $submit->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }

            });

    }

    /**
     * @When /^I click project$/
     */
    public function iClickProject()
    {

       $this->driver->wait(100, 300)->until(function () {
        try {
            $this->driver->navigate()->to($this->url);
            return true;
        } catch (NoSuchElementException $ex) {
            return false;
        }
    });

    }




    /** @AfterStep */
    public function afterFailedStep(AfterStepScope $scope)
    {
        if ($scope->getTestResult()->getResultCode() === TestResult::FAILED) {
            echo $scope->getFeature()->getDescription();
            echo $scope->getFeature()->getFile();
        }
    }

    /** @AfterScenario */
    public function after()
    {
        $this->driver->wait(100, 300)->until(function () {
            try {
                $logout = $this->driver->findElement(WebDriverBy::cssSelector('.fa-power-off'));
                $logout->isDisplayed();
                $logout->click();
                return true;
            } catch (NoSuchElementException $ex) {
                return false;
            }

        });
        $closeBrowser=$this->driver->close();
     }

    public function FindById($css1)
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


}
?>