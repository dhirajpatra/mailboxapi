<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MailDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    	// schema
    	Schema::create('mail_details', function (Blueprint $table) {
    		$table->engine = 'InnoDB';
    		$table->increments('mail_detail_id');
    		$table->integer('mail_detail_uid');
    		$table->string('mail_detail_sender');
    		$table->string('mail_detail_subject');
    		$table->text('mail_detail_message');
    		$table->timestamp('mail_detail_time_sent');
    		$table->tinyInteger('mail_detail_read', 1)->default(0)->comment('0=no, 1=yes');
    		$table->tinyInteger('mail_detail_archive', 1)->default(0)->comment('0=no, 1=yes');
    		$table->timestamps();
    	});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    	Schema::drop('mail_details');
    }
}
