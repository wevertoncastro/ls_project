<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\Behat\Exception\Exception;
use Behat\MinkExtension\Context\MinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends MinkContext
{
    
    private $output;
    
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }
    
    /**
     * @Given /^I am in a directory "([^"]*)"$/
     */
    public function iAmInADirectory($dir)
    {
    	if(!file_exists($dir)) {
    		mkdir($dir);
    	}
    	chdir($dir);
    }

    /**
     * @Given /^I have a file named "([^"]*)"$/
     */
    public function iHaveAFileNamed($file)
    {
    	touch($file);
    }
    
    /**
     * @When /^I run "([^"]*)"$/
     */
    public function iRun($command){
    	exec($command, $output);
    	$this->output = trim(implode("\n", $output));
    }
    
    /**
     * @Then /^I should get:$/
     */
    public function iShouldGet(PyStringNode $string)
    {
    	if((string) $string !== $this->output){
    		throw new Exception(
    			"Actual output is:\n" . $this->output
    		);
    	}
    }
    
    /** 
     * @Then /^I wait for the suggestion box to appear$/
     */
	public function iWaitForTheSuggestionBoxToAppear()
	{
	    $this->getSession()->wait(5000,
	        "$('.suggestions-results').children().length > 0"
	    );
	}
    
	/**
	 * @Given /^the following peaple exist:$/
	 */
	public function thePeopleExist(TableNode $table)
	{
		$hash = $table->getHash();
		
		foreach($hash as $row){
			echo $row['name']." ".$row['email']." ".$row['phone']."\n";
		}
	}
//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
}
