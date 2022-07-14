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

/* Marca */
use App\Actions\Fortify\Marca\MarcaAttemptToAuthenticate;
use App\Actions\Fortify\Marca\MarcaRedirectIfTwoFactorAuthenticatable;
use App\Http\Responses\MarcaLoginResponse;
use App\Models\Marca;
use App\Models\Team;
use App\Actions\Fortify\PasswordValidationRules;
use App\Http\Livewire\DashboardMarca;
use App\Models\Campanhas;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarcaController extends Controller
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

    }

    public function marcaLogin(){
        return view('auth.login', ['guard'=>'marca']);
    }

    public function marca(){
        return redirect()->route('marca.login');
    }

    public function marcaregister(){
        return view('auth.register', ['guard'=>'marca']);
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
            return app(MarcaLoginResponse::class);
        });
    }


    use PasswordValidationRules;
    public function createMarca(Request $request)
    {
        $request->validate([
            'cnpj'=> ['required', 'string'],
            'corporativename'=> ['required', 'string'],
            'brandname'=> ['required', 'string'],
            'branch'=> ['required', 'string', 'max:255'],
            'name'=> ['required', 'string', 'max:255'],
            'email'=> ['required', 'string'],
            'phone'=> ['required', 'string'],
            'password'=>$this->passwordRules(),
            'layout'=>[],
            'language'=>[],
        ]);

        $marca= Marca::create([
            'cnpj'=> $request->cnpj,
            'corporativename'=> $request->corporativename,
            'brandname'=> $request->brandname,
            'branch'=> $request->branch,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'password'=> Hash::make($request->password),
            'layout'=> $request->layout,
            'language'=> $request->language,
        ]);
        event(new Registered($marca));
        Auth::login($marca);
        return redirect()->route('marca.login');
    }

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
            Features::enabled(Features::twoFactorAuthentication()) ? MarcaRedirectIfTwoFactorAuthenticatable::class : null,
            MarcaAttemptToAuthenticate::class,
            PrepareAuthenticatedSession::class,
        ]));
    }


    public function destroy(Request $request): LogoutResponse
    {
        $this->guard->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return app(LogoutResponse::class);
    }

    public function loadmarca($id)
    {
        $marca = Marca::findOrFail($id);

        return view('marca.dashboard' , [
            'marca' => $marca
        ]);

    }

}
