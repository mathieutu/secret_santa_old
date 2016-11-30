<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Session\Store;

class Controller extends BaseController
{
    public function home(Store $session)
    {

        if ($session->has('error')) {
            return view('error')->withUser($session->get('user'));
        }
        if ($session->has('user')) {
            return view('confirmation')->withUser($session->get('user'));
        }

        return view('welcome');
    }
}
