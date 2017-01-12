<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail_detail;


/**
 * Class MailboxapiController
 * @package App\Http\Controllers
 */
class MailboxapiController extends Controller
{
	/**
	 * constructor
	 */
	/* public function __construct()
	{
		// reqires Authentificataion before access
		$this->middleware('auth.basic');
	} */

    /**
     * This method will process list of all mail messages along with their details status [Read of not]
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * eg. JSON Request
     * URL: http://laravel/api/v1/mailbox
     * eg. JSON Response
     * {"error":false,"message":"All mail fetched","mails":{"total":10,"per_page":5,"current_page":1,"last_page":2,"next_page_url":"http:\/\/laravel\/api\/v1\/mailbox?page=2","prev_page_url":null,"from":1,"to":5,"data":[{"mail_detail_id":21,"mail_detail_uid":26,"mail_detail_sender":"Jane Austen","mail_detail_subject":"treasure-hunter","mail_detail_message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","mail_detail_time_sent":"2016-02-29 07:20:27","mail_detail_read":0,"mail_detail_archive":0,"created_at":"2017-01-06 16:19:46","updated_at":"2017-01-06 16:19:46"}.....]}}
     */
    public function index(Request $request)
    {
        try{
            // pagination
            $pageSize = $request->input('limit');
        	// fetch all mails except archive paginated way
            // model obj
            $mailDetailsObj = new Mail_detail();
            $mails = $mailDetailsObj->listMails($pageSize);

            $statusCode = 200;
            return response(array(
                'error' => false,
                'message' => 'All mail fetched',
                'mails' => $mails,
            ), $statusCode);

        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'Mail fetch error',
            ), $statusCode);

        }
    }

    /**
     * This method will process list of all archive mail messages
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * eg. JSON Request
     * URL: http://laravel/api/v1/mailbox/listarchive
     * eg. JSON Response
     * {"error":false,"message":"Archived messages fetch successfully","mails":{"total":2,"per_page":5,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":2,"data":[{"mail_detail_id":15,"mail_detail_uid":26,"mail_detail_sender":"Jane Austen","mail_detail_subject":"treasure-hunter","mail_detail_message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","mail_detail_time_sent":"2017-01-06 21:27:12","mail_detail_read":1,"mail_detail_archive":1,"created_at":"2017-01-06 08:46:25","updated_at":"2017-01-06 08:46:25"},{"mail_detail_id":10,"mail_detail_uid":21,"mail_detail_sender":"Ernest Hemingway","mail_detail_subject":"animals","mail_detail_message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","mail_detail_time_sent":"2017-01-06 21:42:23","mail_detail_read":1,"mail_detail_archive":1,"created_at":"2017-01-06 08:46:25","updated_at":"2017-01-06 16:12:23"}]}}
     */
    public function listArchiveMessages(Request $request)
    {
        try{
            // pagination
            $pageSize = $request->input('limit');
			// fetching all archive mails paginated way
            // model obj
            $mailDetailsObj = new Mail_detail();
            $mails = $mailDetailsObj->listArchive($pageSize);
            //print_r($mails); exit;
            $statusCode = 200;
            return response(array(
                'error' => false,
                'message' =>'Archived messages fetch successfully',
                'mails' => $mails,
            ), $statusCode);

        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'Archived messages fetch error',
            ), $statusCode);

        }
    }

    /**
     * This method will show the message details
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * 
     * eg. JSON Request
     * {"id":"10"}
     * URL: http://laravel/api/v1/mailbox/show
     * eg. JSON Response
     * {"error":false,"message":"Fetched message details successfully","mail":[{"mail_detail_id":10,"mail_detail_uid":21,"mail_detail_sender":"Ernest Hemingway","mail_detail_subject":"animals","mail_detail_message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","mail_detail_time_sent":"2017-01-06 21:42:23","mail_detail_read":1,"mail_detail_archive":1,"created_at":"2017-01-06 08:46:25","updated_at":"2017-01-06 16:12:23"}]}
     */
    public function showMessageDetails(Request $request)
    {
        try{
        	// taking id for that mail
            $id = $request->input('id');
            // model obj
            $mailDetailsObj = new Mail_detail();
            $mailDetails = $mailDetailsObj->showDetails($id);
            //print_r($mailDetails); exit;
            if(!empty($mailDetails)){
            	$statusCode = 200;
            	return response(array(
            			'error' => false,
            			'message' =>'Fetched message details successfully',
            			'mail' => $mailDetails[0],
            	), $statusCode);
            	
            }else{
            	$statusCode = 200;
            	return response(array(
            			'error' => true,
            			'message' =>'Email id is invalid',
            			'mail' => array(),
            	), $statusCode);
            }

        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'Fetched message details error',
            ), $statusCode);
	
        }
    }

    /**
     * This will save messages from json data
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * eg. JSON Request
     * copy directly from json file given
     * URL: http://laravel/api/v1/mailbox/savemessages
     * eg. JSON Response
     * 
     */
    public function saveMessages(Request $request)
    {
        try{
            //print_r($request->messages); exit;
            /*
             * // to read messages from file
             try
            {
                $messages = File::get($filename);
            }
            catch (Illuminate\Filesystem\FileNotFound\Exception $\Exception)
            {
                die("The file doesn't exist");
            }*/

            // mail details model object and save for every message
            $messages = $request->input('messages');
            //print_r($messages); exit;
            // model obj
            $mailDetailsObj = new Mail_detail();
            $update = $mailDetailsObj->saveMessages($messages);

            if($update){ // true

                $statusCode = 200;
                return response(array(
                    'error' => false,
                    'message' =>'New mail messages saved successfully',
                ), $statusCode);

            }else{
                $statusCode = 400;
                return response(array(
                    'error' => true,
                    'message' =>'New mail messages save error',
                ), $statusCode);

            }


        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'New mail messages save error',
            ), $statusCode);

        }
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * eg. JSON Request
     * {"id":"10"}
     * URL: http://laravel/api/v1/mailbox/makearchive
     * eg. JSON Response
     * {"error":false,"message":"Mail arcived updated successfully"}
     */
    public function makeArchive(Request $request)
    {
        try{
            $id = $request->input('id');

            // check and update status
            // model obj
            $mailDetailsObj = new Mail_detail();
            $update = $mailDetailsObj->archiveMail($id);
            
            if($update){  // true

            	$statusCode = 200;
            	return response(array(
            			'error' => false,
            			'message' =>'Mail arcived updated successfully',
            	), $statusCode);
            	 
            }else{
            	$statusCode = 200;
            	return response(array(
            			'error' => true,
            			'message' =>'Email id is invalid',
            			'mail' => array(),
            	), $statusCode);
            }

        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
            'error' => true,
            'message' =>'Mail arcived update error',
            ), $statusCode);

        }

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Symfony\Component\HttpFoundation\Response
     * eg. JSON Request
     * {"id":"1"}
     * URL: http://laravel/api/v1/mailbox/read
     * eg. JSON Response
     * {"error":false,"message":"Mail read updated successfully"}
     */
    public function readMail(Request $request)
    {
        try{
            $id = $request->input('id');

            // model obj
            $mailDetailsObj = new Mail_detail();
            $update = $mailDetailsObj->readMail($id);

            // we can put more check here to check mail is exist etc
            // update as read if not read already

            if($update){ // true
                $statusCode = 200;
                return response(array(
                    'error' => false,
                    'message' =>'Mail read updated successfully',
                ), $statusCode);

            }else{
                $statusCode = 400;
                return response(array(
                    'error' => true,
                    'message' =>'Mail read update error',
                ), $statusCode);

            }


        }catch (\Exception $e){

            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'Mail read update error',
            ), $statusCode);

        }

    }
    
    
}

