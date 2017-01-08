# mailboxapi #
Mailbox REST API. This is a small E-mail client to manage internal messaging. I have been provided a simple prototype for a basic mailbox API in which the provided messages are listed. Each message can be marked as read and you can archive single messages.

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

* List messages 
Retrieve a paginateable list of all messages. Show if messages were read already.

* List archived messages
Retrieve a paginateable list of all archived messages. Show if messages were read already.

* Show message
Retrieve message by id, include read status and if message is achived.

* Read message
This action “reads” a message and marks it as read in database.

* Archive message
This action sets a message to archived. 

Beside the API please also provide a short documentation how to use it and how the endpoints work.
For simplicity we just use a simple HTTP Authorization header.

### Added some primary phpunit tests for most of the APIs.###
More details in /tests/ folder.

==================================================================================================

## This is prototype only need many improvements into production version ##
I have created within a night :). So definitely have room for lot of improvements in production version. Few are below:

* Passport / Oauth2 based API token authentication method for calling REST APIs [https://laravel.com/docs/5.3/passport]
* More checking pvt method before saving or updating data. 
eg. before updating to archive need to check whether it is already updated as archive or not

* Made the whole application as laravel package / module 
* Made total emial client front end along with different menus in left tab and details action in right tab.
* Automtically call API by ajax eg. while open the mail it will call and updated as read

==============================================================================================================
## Main files ##
/routes/api.php
/app/Http/Controllers/MailboxapiController.php
/app/Mail_detail.php
/tests/MailboxTest.php
/database/migration/2017_01_08_093215_mail_details.php [auto generated database migration file to create / update table]


