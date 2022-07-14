<div>
    <x-guest-layout>
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <x-jet-label for="cnpj" value="{{ __('CNPJ') }}" />
                    <x-jet-input id="cnpj" class="block mt-1 w-full" type="text" data-mask="00.000.000/0000-00" data-mask-clearifnomatch="true" name="cnpj" :value="old('cnpj')" onblur="checkcnpj(this.value)" required />
                </div>

                <div>
                    <x-jet-label for="name" value="{{ __('Nome') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="name_artistic" value="{{ __('Nickname') }}" />
                    <x-jet-input id="name_artistic" class="block mt-1 w-full" type="text" name="name_artistic" :value="old('name_artistic')" required />
                </div>

                <div class="mt-4">
                    <label for="cpf">{{__('CPF')}}</label>
                    <input id="cpf" class="block mt-1 w-full" type="text" data-mask="000.000.000-00" data-mask-clearifnomatch="true" name="cpf" value="old('cpf')" onblur= "checkCpf(this.value)" required>
                </div>

                <div class="mt-4">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="email" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password" value="{{ __('Password') }}" />
                    <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                    <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="birthdate" value="{{ __('Data de nascimento') }}" />
                    <x-jet-input id="birthdate" class="block mt-1 w-full" type="date" name="birthdate" :value="old('birthdate')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="genre" value="{{ __('Gênero') }}" />
                    <select id="genre"  class="block mt-1 w-full" name="genre">
                        <option selected>Escolha uma categoria</option>
                        <option value="Anime & Cartoon">Anime & Cartoon</option>
                        <option value="Curiosidades">Curiosidades</option>
                        <option value="Dublagem">Dublagem</option>
                        <option value="Fashion/Moda">Fashion/Moda</option>
                        <option value="Games">Games</option>
                        <option value="Comédia">Comédia</option>
                        <option value="Dança Profissional">Dança Profissional</option>
                        <option value="Gastronomia/Comida">Gastronomia/Comida</option>
                    </select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="fantasyname" value="{{ __('Agência') }}" />
                    <select id="fantasyname"  class="block mt-1 w-full" name="fantasyname">
                        <option selected value="Sem agência">Não possuo agência</option>
                        @foreach ($agencia as $agencias)
                        <option value="{{$agencias->fantasyname}}">{{$agencias->fantasyname}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Telefone') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" data-mask="(00) 00000-0000" required />
                </div>

                <div class="mt-4" style="display:none">
                    <x-jet-input id="agency" class="block mt-1 w-full" type="text" name="agency"  />

                    <x-jet-input id="intagram" class="block mt-1 w-full" type="text" name="instagram"  />

                    <x-jet-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" />

                    <x-jet-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" />

                    <x-jet-input id="kwai" class="block mt-1 w-full" type="text" name="kwai"  />

                    <x-jet-input id="facebook" class="block mt-1 w-full" type="text" name="facebook"  />

                    <x-jet-input id="youtube" class="block mt-1 w-full" type="text" name="youtube" />

                    <x-jet-input id="twitch" class="block mt-1 w-full" type="text" name="twitch"  />

                    <x-jet-input id="nimo" class="block mt-1 w-full" type="text" name="nimo"  />

                    <x-jet-input id="trovo" class="block mt-1 w-full" type="text" name="trovo"  />

                    <x-jet-input id="layout" class="block mt-1 w-full" type="text" name="layout" />

                    <x-jet-input id="engament" class="block mt-1 w-full" type="text" name="engament" />

                    <x-jet-input id="language" class="block mt-1 w-full" type="text" name="language" />

                </div>



                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" />

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4"  type="submit">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
        <script>
            function checkCpf(cpf){
                $.ajax({
                    'url':'https://apigateway.conectagov.estaleiro.serpro.gov.br/api-cpf-light/v2/consulta/cpf/v2/consulta/cpf/'+ cpf.replace(/[^0-9]/g,''),
                    'method':"GET",
                    'dataType':'jsonp',
                    'success':function(data){
                        if (data.nome==undefined) {
                                alert(data.status + ' ' + data.mensagem)
                        }
                        else{
                            document.getElementById('name').value = data.nome;
                            document.getElementById('birthdate').value = data.nacimento;
                        }
                    }
                });
            }
        </script>
        <script>
            function checkCnpj(cnpj){
                $.ajax({
                    'url':'https://receitaws.com.br/v1/cnpj/'+ cnpj.replace(/[^0-9]/g,''),
                    'method':"GET",
                    'dataType':'jsonp',
                    'success':function(data){
                        if (data.nome==undefined) {
                                alert(data.status + ' ' + data.mensagem)
                        }

                    }
                });
            }
        </script>

    </x-guest-layout>
</div>
