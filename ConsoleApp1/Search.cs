using System;
using System.Text;
using System.Threading;
using NUnit.Framework;
using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;
using System.Globalization;


namespace Selenium
{ 
    class Search : TestCase
   {

        public Search(string scenarioName, IWebDriver driver) : base(scenarioName, driver)
        {

        }

        protected override TestResult RunTest()
        {
            return this.SearchFieldCaseTest();
        }

        public TestResult SearchFieldCaseTest()
        {
           
            try
            {
                driver.Manage().Timeouts().PageLoad = TimeSpan.FromSeconds(10);
                Thread.Sleep(10000);
                driver.FindElement(By.CssSelector("#itdev-TopNavigation-root > div:nth-child(1) > div:nth-child(2) > div:nth-child(1) > div:nth-child(1) > div:nth-child(1) > a:nth-child(1) > span:nth-child(1)")).Click();
                Console.WriteLine("Step 1: Find and click on News");
                Thread.Sleep(10000);
            }
            catch (Exception e)
            {
                Console.WriteLine("Step 1 failed " + e);

            }

            try
            {
                driver.FindElement(By.CssSelector("#wyszukaj-aktualno")).SendKeys("News1");
                Console.WriteLine("Step 2: Find and fill search field");
                driver.Manage().Timeouts().PageLoad = TimeSpan.FromSeconds(2);
                Thread.Sleep(1000);
                driver.FindElement(By.ClassName("itdev-filter-filterButton")).Submit();
                Console.WriteLine("Step 3: Approve the search");
            }

            catch (Exception e1)
            {
                Console.WriteLine("Test failed becouse " + e1.Message);

            }
            try
            {
                Assert.AreEqual("News1", driver.FindElement(By.ClassName("news-title")).Text);
                Console.WriteLine("Step 4: Check our search ");
                Console.WriteLine("Step 5: Test completed successfully");
            }
            catch (Exception e2)
            {
                Console.WriteLine("Our news can't by located " + e2.Message);

            }

            return TestResult.Success;

        }

        
    }
}
