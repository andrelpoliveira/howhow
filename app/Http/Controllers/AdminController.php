<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Routing\Pipeline;
use Laravel\Fortify\Actions\EnsureLoginIsNotThrottled;
use Laravel\Fortify\Actions\PrepareAuthenticatedSession;
use Laravel\Fortify\Contracts\LoginViewResponse;
use Laravel\Fortify\Contracts\LogoutResponse;
use Laravel\Fortify\Features;
use Laravel\Fortify\Fortify;
use Laravel\Fortify\Http\Requests\LoginRequest;

/* Admin */
use App\Actions\Fortify\Admin\AdminAttemptToAuthenticate;
use App\Actions\Fortify\Admin\AdminRedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\AdminLoginResponse;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Models\Admin;

class AdminController extends Controller
{
    public function createAgencia(Request $request)
    {
        $request->validate([
            'name'=> ['required', 'string'],
            'email'=> ['required', 'string'],
            'phone'=> ['required', 'string'],
            'office'=>['required', 'string'],
            'password'=> $this->passwordRules(),
            'layout'=> [],
            'language'=> [],
        ]);
        $agencia = Admin::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'office'=> $request->office,
            'password'=> Hash::make($request->password),
            'layout'=> $request->layout,
            'language'=> $request->language,
        ]);
        event(new Registered($agencia));
        Auth::login($agencia);
        return redirect()->route('agencia.login');
    }

    /**
     * The guard implementation.
     *
     * @var \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected $guard;

    /**
     * Create a new controller instance.
     *
     * @param  \Illuminate\Contracts\Auth\StatefulGuard  $guard
     * @return void
     */
    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
        //dd($this->guard);
    }

    public function adminLogin(){

        return view('auth.login', ['guard'=>'admin']);
    }
    public function adminregister(){
        return view('auth.register', ['guard'=> 'admin']);
    }
    /**
     * Show the login view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LoginViewResponse
     */
    public function create(Request $request): LoginViewResponse
    {
        return app(LoginViewResponse::class);
    }

    /**
     * Attempt to authenticate a new session.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return mixed
     */
    public function store(LoginRequest $request)
    {
        return $this->loginPipeline($request)->then(function ($request) {
            return app(AdminLoginResponse::class);
        });
    }

    /**
     * Get the authentication pipeline instance.
     *
     * @param  \Laravel\Fortify\Http\Requests\LoginRequest  $request
     * @return \Illuminate\Pipeline\Pipeline
     */
    protected function loginPipeline(LoginRequest $request)
    {
        if (Fortify::$authenticateThroughCallback) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                call_user_func(Fortify::$authenticateThroughCallback, $request)
            ));
        }

        if (is_array(config('fortify.pipelines.login'))) {
            return (new Pipeline(app()))->send($request)->through(array_filter(
                config('fortify.pipelines.login')
            ));
        }

        return (new Pipeline(app()))->send($request)->through(array_filter([
            config('fortify.limiters.login') ? null : EnsureLoginIsNotThrottled::class,
            Features::enabled(Features::twoFactorAuthentication()) ? AdminRedirectIfTwoFactorAuthenticatable::class : null,
            AdminAttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Laravel\Fortify\Contracts\LogoutResponse
     */
    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }

    public function loadadmin($id)
    {
        $admin = Admin::findOrFail($id);

        return view('dashboard.admin' , ['admin' => $admin]);

    }
    

}
