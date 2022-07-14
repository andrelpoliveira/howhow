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

/* Agencia */
use App\Actions\Fortify\Agencia\AgenciaAttemptToAuthenticate;
use App\Actions\Fortify\Agencia\AgenciaRedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\AgenciaLoginResponse;
use App\Models\Agencia;
use App\Models\Team;
use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AgenciaController extends Controller
{
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

    public function agenciaLogin(){

        return view('auth.login', ['guard'=>'agencia']);
    }

    public function agenciaregister(){
        return view('auth.register', ['guard'=> 'agencia']);
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
            return app(AgenciaLoginResponse::class);
        });
    }

    use PasswordValidationRules;
    public function createAgencia(Request $request)
    {
        $request->validate([
            'cnpj'=> ['required', 'string'],
            'corporativename'=> ['required', 'string'],
            'fantasyname'=> ['required', 'string'],
            'branch'=> ['required', 'string'],
            'name'=> ['required', 'string'],
            'email'=> ['required', 'string'],
            'phone'=> ['required', 'string'],
            'password'=> $this->passwordRules(),
            'layout'=> [],
            'language'=> [],
        ]);
        $agencia = Agencia::create([
            'cnpj'=> $request->cnpj,
            'corporativename'=> $request->corporativename,
            'fantasyname'=> $request->fantasyname,
            'branch'=> $request->branch,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'layout'=> $request->layout,
            'language'=> $request->language,
        ]);
        event(new Registered($agencia));
        Auth::login($agencia);
        return redirect()->route('agencia.login');
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
            Features::enabled(Features::twoFactorAuthentication()) ? AgenciaRedirectIfTwoFactorAuthenticatable::class : null,
            AgenciaAttemptToAuthenticate::class,
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

    public function loadagencia($id)
    {
        $agencia = Agencia::findOrFail($id);

        return view('agencia.dashboard' , ['agencia' => $agencia]);

    }

}
