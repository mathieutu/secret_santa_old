<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Notifications\AccountLinked;
use Carbon\Carbon;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Routing\Controller as BaseController;
use Laravel\Socialite\Contracts\Factory as Socialite;

class RegisterController extends BaseController
{
    /**
     * @var Socialite
     */
    private $socialite;

    /**
     * AuthController constructor.
     *
     * @param Socialite $socialite
     */
    public function __construct(Socialite $socialite)
    {
        $this->socialite = $socialite;
    }

    /**
     * Redirect the user to the Google authentification page.
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function redirectToProvider()
    {
        return $this->socialite->driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        try {
            $googleUser = $this->socialite->driver('google')->user();
        } catch (RequestException $e) {
            return redirect('/')->with([
                'error' => true,
                'user'  => null,
            ]);
        }

        if (Carbon::now()->gte(Carbon::create(2016, 12, 21))) {
            return redirect('/')->with([
                'error' => true,
                'user'  => null,
            ]);
        }

        if (! isset($googleUser->user['domain']) || $googleUser->user['domain'] !== config('app.company_domain')) {
            return redirect('/')->with([
                'error' => true,
                'user'  => new User([
                    'first_name' => $googleUser->user['name']['givenName'],
                    'last_name'  => $googleUser->user['name']['familyName'],
                    'email'      => $googleUser->getEmail(),
                ]),
            ]);
        }

        /** @var User $user */
        $user = User::whereEmail($googleUser->getEmail())->firstOrNew([
            'first_name' => $googleUser->user['name']['givenName'],
            'last_name'  => $googleUser->user['name']['familyName'],
            'email'      => $googleUser->getEmail(),
        ]);

        if (! $user->exists) {
            $user->save();
            $user->notify(new AccountLinked());
        }

        return redirect('/')->withUser($user);
    }
}
