<?php 

require dirname(__DIR__) . '/vendor/autoload.php';
require dirname(__DIR__) . '/bootstrap/app.php';

use App\Models\User;

$user = User::where('username', 'user')->firstOrFail();

dd($user);