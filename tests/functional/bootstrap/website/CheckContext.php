<?php
namespace B24\Tests\Functional\bootstrap\website;

use Behat\Behat\Context\Context;



final class CheckContext implements Context
{
    protected $url;
    protected $page;



    /**
     * @Given /^Web address is "([^"]*)"$/
     */
    public function webAddressIs($url)
    {
        $this->url=$url;
    }
    /**
     * @When /^Enter this site/
     */
    public function enterThisSite()
    {
        $page = curl_init();

        curl_setopt($page, CURLOPT_USERAGENT,"Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36)");
        curl_setopt($page, CURLOPT_URL, $this->url );
        curl_setopt($page, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($page, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($page, CURLOPT_RETURNTRANSFER,1);

        $this->page=curl_exec($page);
       // $error=curl_error($client);
        curl_close($page);
    }

    /**
     * @Then /^Check text "([^"]*)"$/
     */
    public function checkText($check)
    {

        $result=strstr($this->page, $check);
        \PHPUnit_Framework_Assert::assertInternalType("string",$result);

}
}

