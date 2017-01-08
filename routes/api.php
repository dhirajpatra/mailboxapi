<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/* Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api'); */

/**
 * routes for mailbox api 
 */
Route::group(array('prefix' => 'v1'), function() {
    Route::post('mailbox','MailboxapiController@index');
    Route::post('mailbox/savemessages','MailboxapiController@saveMessages');
    Route::post('mailbox/listarchive','MailboxapiController@listArchiveMessages');
    Route::post('mailbox/show','MailboxapiController@showMessageDetails');
    Route::post('mailbox/makearchive','MailboxapiController@makeArchive');
    Route::post('mailbox/read','MailboxapiController@readMail');
});
