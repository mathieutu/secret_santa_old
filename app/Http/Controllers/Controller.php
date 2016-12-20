<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
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

        if (Carbon::now()->gte(Carbon::create(2016, 12, 21))) {
            return view('too-late');
        }

        return view('welcome');
    }
}
