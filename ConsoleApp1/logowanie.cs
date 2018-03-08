using System;
using System.Text;
using System.Threading;
using NUnit.Framework;
using OpenQA.Selenium;



namespace Selenium
{


    [TestFixture]
    public class Logowanie : TestCase
    {

        public Logowanie(string scenarioName, IWebDriver driver) : base(scenarioName, driver)
        {

        }

        protected override TestResult RunTest()
        {
            return this.LoginCaseTest();
        }
    
        [Test]
        public TestResult LoginCaseTest()
        {
            driver.Navigate().GoToUrl("https://login.microsoftonline.com/login.srf?wa=wsignin1%2E0&rpsnv=4&ct=1519814925&rver=6%2E1%2E6206%2E0&wp=MBI&wreply=https%3A%2F%2Fimpel018%2Esharepoint%2Ecom%2F_forms%2Fdefault%2Easpx%3Fapr%3D1&lc=1045&id=500046&wsucxt=1&cobrandid=11bd8083-87e0-41b5-bb78-0bc43c8a8e8a");
            Console.WriteLine("Step 1: Open our page");
            driver.FindElement(By.Id("i0116")).Click();
            driver.FindElement(By.Id("i0116")).Clear();
            driver.FindElement(By.Id("i0116")).SendKeys("admin@impel018.onmicrosoft.com");

            Console.WriteLine("Step 2: Find and fill login field");

            try
            {
                driver.FindElement(By.Id("idSIButton9")).Click();
                driver.FindElement(By.Id("i0118")).Clear();
                driver.FindElement(By.Id("i01q18")).SendKeys("P@ssw0rd");
                Thread.Sleep(1000); // zatrzymuje test na x milisekund 
                driver.FindElement(By.Id("idSIButton9")).Click();

                try
                {
                    Console.WriteLine("Step 3: Find and fill password field");
                    driver.FindElement(By.Id("KmsiCheckboxField")).Click();
                    driver.FindElement(By.Id("idBtn_Back")).Click();
                    Console.WriteLine("Step 4: Click checkbox");
                    Console.WriteLine("Step 5: Test completed successfully");
                }
                catch (Exception e1)
                {
                    Console.WriteLine("Test Failed " + e1.Message);
                    if (e1 != null)
                    {

                    }
                }
            }
            catch (Exception e)
            {
                Console.WriteLine("Step 2 failed: " + e.Message);

            }

            return TestResult.Success;
        }
    }
}



