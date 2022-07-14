<div>
    <x-guest-layout>
        <x-jet-authentication-card>
            <x-slot name="logo">
                <x-jet-authentication-card-logo />
            </x-slot>

            <x-jet-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('marca.register') }}">
                @csrf

                <div class="mt-4">
                    <label for="cnpj">{{__('CNPJ')}}</label>
                    <input id="cnpj" class="block mt-1 w-full" type="text" data-mask="00.000.000/0000-00" data-mask-clearifnomatch="true" name="cnpj" value="old('cnpj')" onblur= "checkCnpj(this.value)" required>
                </div>

                <div>
                    <x-jet-label for="corporativename" value="{{ __('Nome corporativo') }}" />
                    <x-jet-input id="corporativename" class="block mt-1 w-full" type="text" name="corporativename" :value="old('corporativename')" required autofocus autocomplete="name" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="brandname" value="{{ __('Nome de marca') }}" />
                    <x-jet-input id="brandname" class="block mt-1 w-full" type="text" name="brandname" :value="old('brandname')" required />
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
                    <x-jet-label for="branch" value="{{ __('Ramo') }}" />
                    <x-jet-input id="branch" class="block mt-1 w-full" type="text" name="branch" :value="old('branch')" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="phone" value="{{ __('Telefone') }}" />
                    <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" data-mask="(00) 00000-0000" required />
                </div>

                <div class="mt-4">
                    <x-jet-label for="responsible" value="{{ __('Responsável') }}" />
                    <x-jet-input id="responsible" class="block mt-1 w-full" type="text" name="responsible" :value="old('responsible')" required />
                </div>

                <!-- Display None -->


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
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('marca.login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-jet-button class="ml-4">
                        {{ __('Register') }}
                    </x-jet-button>
                </div>
            </form>
        </x-jet-authentication-card>
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
                        else{
                            document.getElementById('corporativename').value = data.nome;
                            document.getElementById('brandname').value = data.fantasia;
                        }
                    }
                });
            }
        </script>
    </x-guest-layout>

   <script>
        function checkCNPJ(cnpj)
        {
            $.ajax({
                'url':'https://receitaws.com.br/v1/cnpj/' + cnpj.replace(/[^0-9]/g, ''),
                'method': "GET",
                'dataType': 'jsonp',
                'sucess': function(data)
                {
                    if(data.nome == undefined)
                    {
                        alert(data.status + ' ' + data.message);
                    }
                    else
                    {
                        document.getElementById('corporativename').value = data.nome;
                        document.getElementById('brandname').value = data.fantasia;

                    }
                }
            });
        }
    </script>

</div>
