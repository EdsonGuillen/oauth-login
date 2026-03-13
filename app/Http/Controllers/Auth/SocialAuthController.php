<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthController extends Controller
{
    protected array $allowedProviders = ['discord', 'github'];

    public function redirect(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    public function callback(string $provider)
    {
        if (!in_array($provider, $this->allowedProviders)) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Error al autenticar con ' . ucfirst($provider) . '. Intenta de nuevo.');
        }

        $email = $socialUser->getEmail()
            ?? $provider . '_' . $socialUser->getId() . '@noemail.local';

        // Busca por provider_id primero, luego por email
        $user = User::where('provider', $provider)
                    ->where('provider_id', $socialUser->getId())
                    ->first();

        if (!$user) {
            $user = User::where('email', $email)->first();
        }

        if ($user) {
            // Actualiza datos del proveedor
            $user->update([
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar'      => $socialUser->getAvatar(),
                'name'        => $socialUser->getName() ?? $socialUser->getNickname() ?? $user->name,
            ]);
        } else {
            // Crea usuario nuevo
            $user = User::create([
                'name'        => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Usuario',
                'email'       => $email,
                'provider'    => $provider,
                'provider_id' => $socialUser->getId(),
                'avatar'      => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user, remember: true);

        return redirect('/dashboard');
    }
}
