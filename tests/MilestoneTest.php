<?php
require_once('fergcorp_milestone.php');

/**
 * Milestone Tests
 */

class MilestoneTest extends WP_UnitTestCase {
    public $plugin_slug = 'milestone';
	private $plugin;
	
	//TOTEST:
	/* Input validation? Only test valid inputs...don't test for invalid?
	 * Test date manipulation
	 * Test Defaults
	 * Test blanks (e.g. database corruption)
	 * 
	*/
	  
	

    public function setUp() {
        parent::setUp();
		$GLOBALS['milestone'] = new Fergcorp_Milestone_Widget();
        $this->plugin = $GLOBALS['milestone'];
		
    }


    public function testTrueStillEqualsTrue() {
        $this->assertTrue(true);
    }

	
	public function testUpdate(){

		$oldinstance = array();
		$newinstance = array(
								'title' => "My Title",
								'event' => "My Event",
								'month' => 1,
								'day' => 31,
								'year' => 2015,
								'hour' => 12,
								'minute' => 30,
								'message' => "Happy Birthday!"
								);
								
		$resultUpdate = $this->plugin->update($newinstance, $oldinstance);
		
		$this->assertTrue( is_array( $resultUpdate ) );
		
		foreach ($newinstance as $name => $value) {
			$this->assertTrue(isset($resultUpdate[$name]));
			$this->assertEquals($value, $resultUpdate[$name]);
		}
		
		//Month
		for($i=1; $i<12; $i++){
			$newinstance["month"] = $i; //Set new year
			$resultUpdate = $this->plugin->update($newinstance, $oldinstance); //Update instance
			$this->assertEquals($i, $resultUpdate["month"]);
		}
		
		//Day
		for($i=1; $i<31; $i++){
			$newinstance["day"] = $i; //Set new year
			$resultUpdate = $this->plugin->update($newinstance, $oldinstance); //Update instance
			$this->assertEquals($i, $resultUpdate["day"]);
		}
				
		//Year
		for($i=2000; $i<2100; $i++){
			$newinstance["year"] = $i; //Set new year
			$resultUpdate = $this->plugin->update($newinstance, $oldinstance); //Update instance
			$this->assertEquals($i, $resultUpdate["year"]);
		}
		
		//Hour
		for($i=1; $i<60; $i++){
			$newinstance["hour"] = $i; //Set new year
			$resultUpdate = $this->plugin->update($newinstance, $oldinstance); //Update instance
			$this->assertEquals($i, $resultUpdate["hour"]);
		}
		
		//Minute
		for($i=1; $i<60; $i++){
			$newinstance["minute"] = $i; //Set new year
			$resultUpdate = $this->plugin->update($newinstance, $oldinstance); //Update instance
			$this->assertEquals($i, $resultUpdate["minute"]);
		}
		
		
	}

   /*public function testAppendContent() {
        $this->assertEquals( "<p>Hello WordPress Unit Tests</p>", $this->my_plugin->append_content(''), '->append_content() appends text' );
    }

    /**
     * A contrived example using some WordPress functionality
     */
     /*
    public function testPostTitle() {
        // This will simulate running WordPress' main query.
        // See wordpress-tests/lib/testcase.php
        $this->go_to('http://localhost/~andrewferguson/wordpress/?p=1');

        // Now that the main query has run, we can do tests that are more functional in nature
        global $wp_query;
        $post = $wp_query->get_queried_object();
        $this->assertEquals('Hello world!', $post->post_title );
    }*/


}
