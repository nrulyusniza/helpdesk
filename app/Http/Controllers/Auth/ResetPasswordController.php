<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Models\User;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }

    public function showResetForm(Request $request, $token = null)
    {
        // Retrieve the user based on their username
        $user = User::where('username', $request->username)->first();

        // Add your logic here to check if the user is a super admin
        // If not a super admin, you can redirect them to a different route or show an error message

        if (user()->role_id==1) {
            return view('auth.passwords.reset')->with(
                ['token' => $token, 'username' => $user->username]
            );
        } else {
            // Redirect or show an error message for non-admin users
            return redirect()->route('home')->with('error', 'You are not authorized to reset passwords.');
        }
        
        /*return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );*/
    }
}
