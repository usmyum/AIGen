<?php

namespace App\Http\Controllers\Auth;

use App\Events\UsersActivityEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Setting;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Jobs\SendConfirmationEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Google2FA;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('panel.authentication.login', [
            'plan' => request('plan'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {

        $settings = Setting::first();
        if ((bool)$settings->login_without_confirmation == false) {
            $user = User::where('email', $request->email)->first();
			if (!$user) {
				$data = array(
					'errors' => [trans('auth.failed')],
				);
				return response()->json($data, 401);
			}
            if ($user and $user->email_confirmed != 1 and $user->type != 'admin') {
                dispatch(new SendConfirmationEmail($user));
                $data = array(
                    'errors' => [__('We have sent you an email for account confirmation. Please confirm your account to continue. Please also check your spam folder')],
                    'type' => 'confirmation',
                );
                return response()->json($data, 401);
            }
			
        }

        $request->authenticate();

        $request->session()->regenerate();


        if (Auth::check()) {
			$user = Auth::user();
            if (Google2FA::isActivated()) {
                $user_id = Auth::id();

                Auth::logout();

                session()->put('user_id', $user_id);
                session()->save();

                return response()->json([
                    'link' => '2fa/login'
                ]);
            }

			$user = Auth::user();
			$ip = $request->ip();
			$connection = $request->header('User-Agent');
			event(new UsersActivityEvent($user->email, $user->type, $ip, $connection));
        }

        if ($plan = $request->get('plan'))
        {
            return response()->json([
                'link' => '/dashboard/user/payment?plan='. $plan
            ]);
        }

        return response()->json([
            'link' => '/dashboard'
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}