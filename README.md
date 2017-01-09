# mailboxapi #
Mailbox REST API with Laravel. This is a small E-mail client to manage internal messaging. I have been provided a simple prototype for a basic mailbox API in which the provided messages are listed. Each message can be marked as read and you can archive single messages.
### Used ###
PHP 7.0, mysql 5.6, apache 2.4 in Ubuntu 16.04
Laravel 5.2

==========================================================================================================================
## Specifications ##

Import messages from a JSON file
To seed the database with some example messages there is a JSON file provided which needs to be
imported into the database. Please write a task which can import this messages into the datab
messages_sample.json
 
Shared on /helpdocuments/ folder


### API lists ###

Message API
The main task is to build an API for the messages. It should to be a REST based API with a JSON
formatted payloads.
The API should support the following use-cases.

* Save Messages
This will save all messages into database from json data.

JSON Request

copy directly from json file given
[ /helpdocuments/messages_sample.json ]
---
URL: http://laravel/api/v1/mailbox/savemessages

eg. JSON Response
{'error': 'false',
 'message':'New mail messages saved successfully'}
 ---

* List messages 
Retrieve a paginateable list of all messages. Show if messages were read already. Paginated way.

JSON Request

URL: http://laravel/api/v1/mailbox

JSON Response
     {"error":false,"message":"All mail fetched","mails":{"total":10,"per_page":5,"current_page":1,"last_page":2,"next_page_url":"http:\/\/laravel\/api\/v1\/mailbox?page=2","prev_page_url":null,"from":1,"to":5,"data":[{"mail_detail_id":21,"mail_detail_uid":26,"mail_detail_sender":"Jane Austen","mail_detail_subject":"treasure-hunter","mail_detail_message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","mail_detail_time_sent":"2016-02-29 07:20:27","mail_detail_read":0,"mail_detail_archive":0,"created_at":"2017-01-06 16:19:46","updated_at":"2017-01-06 16:19:46"}.....]}}
---
     
* List archived messages
Retrieve a paginateable list of all archived messages. Show if messages were read already. Paginated way.

JSON Request

URL: http://laravel/api/v1/mailbox/listarchive

JSON Response
{"error":false,"message":"Archived messages fetch successfully","mails":{"total":2,"per_page":5,"current_page":1,"last_page":1,"next_page_url":null,"prev_page_url":null,"from":1,"to":2,"data":[{"mail_detail_id":15,"mail_detail_uid":26,"mail_detail_sender":"Jane Austen","mail_detail_subject":"treasure-hunter","mail_detail_message":"The story is about a treasure-hunter and a treasure-hunter who is constantly annoyed by a misguided duke. It takes place on a forest planet in a galaxy-spanning commonwealth. The critical element of the story is a door being opened","mail_detail_time_sent":"2017-01-06 21:27:12","mail_detail_read":1,"mail_detail_archive":1,"created_at":"2017-01-06 08:46:25","updated_at":"2017-01-06 08:46:25"}...]}}
---

* Show message
Retrieve message by id, include read status and if message is achived.

JSON Request
{"id":"10"}
---
URL: http://laravel/api/v1/mailbox/show

JSON Response
{"error":false,"message":"Fetched message details successfully","mail":[{"mail_detail_id":10,"mail_detail_uid":21,"mail_detail_sender":"Ernest Hemingway","mail_detail_subject":"animals","mail_detail_message":"This is a tale about nihilism. The story is about a combative nuclear engineer who hates animals. It starts in a ghost town on a world of forbidden magic. The story begins with a legal dispute and ends with a holiday celebration.","mail_detail_time_sent":"2017-01-06 21:42:23","mail_detail_read":1,"mail_detail_archive":1,"created_at":"2017-01-06 08:46:25","updated_at":"2017-01-06 16:12:23"}]}
---
     
* Read message
This action “reads” a message and marks it as read in database.

JSON Request
{"id":"1"}

URL: http://laravel/api/v1/mailbox/read

JSON Response
{"error":false,"message":"Mail read updated successfully"}
---

* Archive message
This action sets a message to archived. 

JSON Request
{"id":"10"}
---
URL: http://laravel/api/v1/mailbox/makearchive

JSON Response
{"error":false,"message":"Mail arcived updated successfully"}
---


Beside the API please also provide a short documentation how to use it and how the endpoints work.
For simplicity we just use a simple HTTP Authorization header.

### Added some primary phpunit tests for most of the APIs.###
More details in /tests/ folder.

==================================================================================================

## This is a prototype. We can make many improvements for production version ##
I have created within a night :). So definitely have room for lot of improvements in production version. Few are below:

* Passport / Oauth2 based API token authentication method for calling REST APIs [https://laravel.com/docs/5.3/passport]
* More checking pvt method before saving or updating data. 
eg. before updating to archive need to check whether it is already updated as archive or not

* Made the whole application as laravel package / module 
* Made total emial client front end along with different menus in left tab and details action in right tab.
* Automtically call API by ajax eg. while open the mail it will call and updated as read

==============================================================================================================
## Main files ##
* /routes/api.php
* /app/Http/Controllers/MailboxapiController.php
* /app/Mail_detail.php
* /tests/MailboxTest.php
* /database/migration/2017_01_08_093215_mail_details.php [auto generated database migration file to create / update table]

### How to run ###
This is full Laravel development framework. Where all REST API has been implemented. You can change the database connections configuration. Also change the route as per your document root for application folder. eg. http://laravel/ [virtual host]

Git clone or download the whole folder into your document root or in virtual host. 
And then run following commands from terminal:
###php artisan make:migration mail_details###

Used REST client to test API. 
Few Screen Shots from testing by rest client:
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/dfd_mail_box_api.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/phpunit_test_result.jpg)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_list.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_show.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_listarchive.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_makearchive.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_read.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_savemessages_1.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/rest_savemessages_2.png)
![ScreenShot](https://github.com/dhirajpatra/mailboxapi/blob/master/helpdocuments/mail_details_dbtable.png)