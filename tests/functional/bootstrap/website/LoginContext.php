<?php
namespace B24\Tests\Functional\bootstrap\website;
Use behat;
use Behat\Behat\Context\Context;
use Behat\Behat\Hook\Scope\AfterStepScope;
use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\TableNode;
use Behat\Mink\Element\NodeElement;
use Behat\Mink\WebAssert;
use Behat\Testwork\Tester\Result\TestResult;
use GuzzleHttp\Client as GuzzleClient;
use Behat\Mink\Mink;
use Behat\Mink\Session;
use Behat\Mink\Driver\Selenium2Driver;
use Behat\MinkExtension\Context\MinkContext;



class LoginContext implements Context
{
    protected $session;
    protected $url;
    protected $find;
    protected $webAssert;

    /**
     * @return mixed
     */
    public function __construct()
    {

        $guzzleClient = new GuzzleClient(array('allow_redirects' => true, 'cookies' => true, 'verify' => false));
        $client = new \Behat\Mink\Driver\Goutte\Client();
        $client->setClient($guzzleClient);
        $driver = new \Behat\Mink\Driver\BrowserKitDriver($client);
        $this->session = new \Behat\Mink\Session($driver);
        $this->webAssert = new WebAssert($this->session);

        //         start the session
        $this->session->start();

    }

        /** @AfterStep */
        public function afterFailedStep(AfterStepScope $scope)
        {
            if ($scope->getTestResult()->getResultCode() === TestResult::FAILED)
            {

                echo $scope->getFeature()->getFile();
                echo  $scope->getStep()->getText();
                $bot_name = 'Functional tests';
                $attachments = array([
                    'title'    => 'Error',
                    'fallback' => 'Error',
                    'color'    => '#FE2A1D',
                    'fields'   => array(
                        [
                            'title' => 'Error in step: ',
                            'value' =>$scope->getStep()->getText(),
                            'short' => true
                        ],
                        [
                            'title' => 'Failed scenarios:',
                            'value' => $scope->getFeature()->getFile(),
                            'short' => true
                        ]
                    )
                ]);
                $params = array(
                    "attachments" => $attachments,
                    "username"    => $bot_name);
                $url = 'https://hooks.slack.com/services/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';


                $data_json = json_encode($params);

                $ci = curl_init();
                curl_setopt($ci, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data_json)));
                curl_setopt($ci, CURLOPT_URL, $url);
                curl_setopt($ci, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ci, CURLOPT_POSTFIELDS, $data_json);
                curl_setopt($ci, CURLOPT_TIMEOUT, 300);
                curl_setopt($ci, CURLOPT_RETURNTRANSFER, 1);

                $response = curl_exec($ci);



            }
        }

        /**
         * @Given /^Web address is "([^"]*)"$/
         */
        public function webAddressIs($page)
        {
            $this->url = $page;
        }


        /**
         * @When /^Enter this web address$/
         */
        public function enterThisWebAddress()
        {
            $this->session->visit($this->url);

        }

        /**
         * @Given /^I use "([^"]*)" as login and "([^"]*)" as password$/
         */
        public function iUseAsLoginAndAsPassword($login, $pass)
        {
            $page = $this->session->getPage();


            $loginField = $page->find("xpath", '//*[@id="login"]');
            $passField = $page->find("xpath", '//*[@id="password"]');
            if ($loginField !== null){

                $loginField->setValue($login);
            }

            if ($passField !== null)
            {

                $passField->setValue($pass);
            }
        }


        /**
         * @Given /^I find login field$/
         */
        public function iFindLoginField()
        {
            $this->webAssert->elementExists('xpath', '//*[@id="login"]');
        }


        /**
         * @Given /^I find password field$/
         */
        public function iFindPasswordField()
        {
            $this->webAssert->elementExists("xpath", '//*[@id="password"]');
        }

        /**
         * @Given /^I find the login button$/
         */
        public function iFindTheLoginButton()
        {
            $this->webAssert->elementExists('xpath', '//*[@id="login_form"]');
        }

        /**
         * @Given /^I press the login  button$/
         */
        public function iPressTheLoginButton()
        {
            $page=$this->session->getPage();
            $page->find('xpath', '//*[@id="login_form"]')->submit();
        }



        /**
         * @Then /^I am logged in$/
         */
        public function iAmLoggedIn()
        {

            $page = $this->session->getPage();
            $element =  $page->find("xpath", '//*[@id="panel_projects_list"]/div/div[2]/div[1]');
            \PHPUnit_Framework_Assert::assertInstanceOf(NodeElement::class, $element);

        }

    //SHOW PAGE
    //$testPage=$this->session->getPage()->getHtml();
    //var_dump($testPage);

    /**
     * @Then /^Check if we are logged$/
     */
    public function checkIfWeAreLogged()
    {
        $check = $this->session->getPage();
            \PHPUnit_Framework_Assert::assertInstanceOf(NodeElement::class, $check->find("css", '.error'));
            \PHPUnit_Framework_Assert::assertNull($check->find('css', '.panel_heading'));


    }
    /**
     * @Given /^I fill (.*) and (.*)$/
     */
    public function iFillAnd($login, $password)
    {
        $page=$this->session->getPage();
        $page->find("xpath", '//*[@id="login"]')->setValue($login);
        $page->find("xpath", '//*[@id="password"]')->setValue($password);

    }




}


