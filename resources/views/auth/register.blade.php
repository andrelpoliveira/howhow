@if (Route::is('register'))
    @livewire('influencer-register')
@endif

@if (Route::is('agencia.register'))
    @livewire('agencia-register')
@endif

@if (Route::is('admin.register'))
    @livewire('admin-register')
@endif

@if (Route::is('marca.register'))
    @livewire('marca-register')
@endif

