<?php
/**
 * Created by PhpStorm.
 * User: dhirajwebappclouds
 * Date: 12/1/17
 * Time: 11:48 AM
 */

namespace App;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;
}