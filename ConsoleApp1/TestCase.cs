using System;
using NUnit.Framework;
using OpenQA.Selenium;
using OpenQA.Selenium.Firefox;

namespace Selenium
{

    public abstract class TestCase
    {
        protected IWebDriver driver;
        public string scenarioName;
        private TestResult result;

        public TestResult Result
        {
            get
            {
                return this.result;
            }
        }

        [SetUp]
        public void SetupTest()
        {
            driver = new FirefoxDriver(); 
        }
    }

}
