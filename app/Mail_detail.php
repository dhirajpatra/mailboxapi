<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Mail_details table model
 * @author dhiraj
 *
 */
class Mail_detail extends Model
{
    // table name different than model naming conventions
    protected $table = 'mail_details';

    //const CREATED_AT = 'creation_date';
    //const UPDATED_AT = 'last_update';

    /**
     * This method will fetch all archive data
     * @return mixed
     */
    public function listArchive()
    {
        try {
            // fetch all
            $mails = $this->where('mail_detail_archive', 1)
                ->orderBy('mail_detail_id', 'desc')
                ->paginate(5)
                ->toArray();

            return $mails;

        }catch (Exception $e){

            return array();

        }
    }

    /**
     * This method will fetch all mails except archive mail
     * @return mixed
     */
    public function listMails()
    {
        try {
            // fetching mails
            $mails = $this->where([
                    ['mail_detail_archive', 0]
                ])
                ->orderBy('mail_detail_id', 'desc')
                ->paginate(5)
                ->toArray();

            return $mails;

        }catch (Exception $e){

            return array();

        }
    }

    /**
     * This method will update the read status of a mail
     * @param $id
     * @return bool
     */
    public function readMail($id)
    {
        try {
            // updating mail
            $this->where([
                        ['mail_detail_id', $id],
                        ['mail_detail_read', 0]
                    ])
                ->update(['mail_detail_read' => 1]);

            return true;

        }catch (Exception $e){

            return false;

        }

    }

    /**
     * This method will update a mail as archive
     * @param $id
     * @return bool
     */
    public function archiveMail($id)
    {
        
        try {
            // verify email
            $mailDetails = $this->_checkMail($id);

            if(!empty($mailDetails)) {
                // update to archive if not already
                Mail_detail::where([
                        ['mail_detail_id', $id],
                        ['mail_detail_archive', 0]
                    ])
                    ->update(['mail_detail_archive' => 1]);

                return true;

            }else{
                return false;

            }

        }catch (Exception $e){

            return false;

        }

    }

    /**
     * This will fetch a message details
     * @param $id
     * @return array
     */
    public function showDetails($id)
    {
        try {
            // verify email id
            $mailDetails = $this->_checkMail($id);

            if(!empty($mailDetails)) {
                // fetching mail details
                $mails = $this->where([
                    ['mail_detail_id', $id]
                ])
                    ->get()
                    ->toArray();

                return $mails;

            }else{
                return array();

            }

        }catch (Exception $e){

            return array();

        }
    }

    /**
     * This will save new messages into db
     * @param $messages
     * @return bool
     */
    public function saveMessages($messages)
    {

       if(!empty($messages)){
           //print_r($messages); exit;
           // saving all data
            foreach ( $messages as $message ) {
                $mailDetail = new Mail_detail();

                $mailDetail->mail_detail_uid = $message['uid'];
                $mailDetail->mail_detail_sender = $message['sender'];
                $mailDetail->mail_detail_subject = $message['subject'];
                $mailDetail->mail_detail_message = $message['message'];
                $mailDetail->mail_detail_time_sent = date("Y-m-d H:i:s", $message['time_sent']);
                $mailDetail->mail_detail_read = 0;
                $mailDetail->mail_detail_archive = 0;

                $mailDetail->save();
            }

           return true;
       }

        return false;

    }

    /**
     * Check whether the mail is valid then send details otherwise empty array
     * @param unknown $id
     * @return boolean
     */
    private function _checkMail($id)
    {
        try{
            // fetching mail details
            $mailDetails = $this->where([
                ['mail_detail_id', $id]
            ])
                ->get()
                ->toArray();
            if(!empty($mailDetails)){
                return $mailDetails;

            }else{
                return array();
            }

        }catch (Exception $e){
            $statusCode = 400;
            return response(array(
                'error' => true,
                'message' =>'Mail read update error',
            ), $statusCode);

        }
    }
}
