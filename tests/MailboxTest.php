<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

/**
 * Mailboxapi tests
 * @author dhiraj
 *
 */
class MailboxTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }
    
    /**
     * this will test the mail list
     * @return json array
     */
    public function testList()
    {
    	$this->json('POST', '/api/v1/mailbox')
    	->seeJson([
    			'error' => false,
                'message' => 'All mail fetched'
    		]);
    }
    
    /**
     * this will test the mail list
     * @return json array
     */
    public function testListstructure()
    {
    	$this->post('/api/v1/mailbox')
    	->seeJsonStructure([
    			"error",
    			"message",
    			"mails" =>
    				[
    					"total",
    					"per_page",
    					"current_page",
    					"last_page",
    					"next_page_url",
    					"prev_page_url",
    					"from",
    					"to",
    					"data" => 
    						[	
    							"*" =>    							
			    				[
			    					"mail_detail_id",
			    					"mail_detail_uid",
			    					"mail_detail_sender",
			    					"mail_detail_subject",
			    					"mail_detail_message",
			    					"mail_detail_time_sent",
			    					"mail_detail_read",
			    					"mail_detail_archive",
			    					"created_at",
			    					"updated_at"
			    				]
    						]
    			]
    			
    	]);
    }
    
    /**
     * this functional test
     * @return void
     */
    public function testShow()
    {
    	$this->post('/api/v1/mailbox/show', ['id' => '1'])
    	->seeJson([
    			'error' => false,
    			'message' => 'Fetched message details successfully'
    	]);
    	
    	//$this->assertEquals(200, $response->status());
    }
    
    /**
     * this functional test
     * @return void
     */
    public function testShowstructure()
    {
    	 $this->post('/api/v1/mailbox/show', ['id' => '1'])
    	 ->seeJsonStructure([
	    	 	"error",
    	 		"message",
    	 		"mail" => [
    	 		"mail_detail_sender",
    	 		"mail_detail_subject",
    	 		"mail_detail_message",
    	 		"mail_detail_time_sent",
    	 		"mail_detail_read",
    	 		"mail_detail_archive",
    	 		"created_at",
    	 		"updated_at"
    	 		]
    	 ]);
    	//$this->assertEquals(200, $response->status());
    }
    
    /**
     * this functional test
     * @return void
     */
    public function testMakearchive()
    {
    	$this->post('/api/v1/mailbox/makearchive', ['id' => '2'])
    	->seeJsonEquals([
    			'error' => false,
    			'message' => 'Mail arcived updated successfully'
    	]);
    	//$this->assertEquals(200, $response->status());
    }
    
    /**
     * this functional test
     * @return void
     */
    public function testRead()
    {
    	$this->post('/api/v1/mailbox/read', ['id' => '2'])
    	->seeJsonEquals([
    			'error' => false,
    			'message' => 'Mail read updated successfully'
    	]);
    	//$this->assertEquals(200, $response->status());
    }
}
