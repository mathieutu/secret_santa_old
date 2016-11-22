<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Response;
use Laravel\Socialite\Contracts\Factory as Socialite;

class AuthController extends Controller
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
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return $this->socialite->driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback()
    {
        $googleUser = $this->socialite->driver('google')->user();

        if ($googleUser->user['domain']!== config('app.company_domain')) {
            return redirect('/')
                ->withErrors('Désolé, ton compte n\'as pas été reconnu. \n
                 Seuls les comptes ' . config('app.company_domain') . 'sont autorisés.');
        }

        $user = User::whereEmail($googleUser->getEmail())->firstOrCreate([
            'first_name' => $googleUser->user['name']['givenName'],
            'last_name'  => $googleUser->user['name']['familyName'],
            'email'      => $googleUser->getEmail(),
        ]);

        return redirect('/')->with(compact('user'));
    }
}
