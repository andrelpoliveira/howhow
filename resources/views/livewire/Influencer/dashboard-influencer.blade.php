<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá {{ Auth::user()->name }}
            </h2>
        </x-slot>

        <div id="search-container" class="col-md-12">
            <h1>Busque burro otario</h1>
            <form action="/dashboard" method="GET">
                <input type="text" id="search" name="search" class="form-control" placeholder="procuro um otario">
            </form>
        </div>

        <div class="py-12">
            <h1>
                Mobrallll
            </h1>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($influencers as $influencer)
                <div class="card" style="width: 18rem;">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{$influencer->name}}</h5>
                      <p class="card-text">{{$influencer->phone}}</p>
                    </div>
                    <ul class="list-group list-group-flush">
                      <li class="list-group-item">An item</li>
                      <li class="list-group-item">A second item</li>
                      <li class="list-group-item">A third item</li>
                    </ul>
                    <div class="card-body">
                      <a href="#" class="card-link">Card link</a>
                      <a href="#" class="card-link">Another link</a>
                    </div>
                  </div>
                @endforeach
            </div>

            
        </div>
        

        <!-- Botão chamada modal Redes -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#socialmediaModal" id="buttonSocialMedia">
            cadastro rede social
        </button>
        <!-- Botão chamada modal Cadastro -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#atualizarDadosModal" id="buttonatualizarDados">
            Editar Dados Pessoais
        </button>

     <!-- Script de focus do modal do cadastro de redes-->
     <script>
        const myModal = document.getElementById('socialmediaModal')
        const myInput = document.getElementById('buttonSocialMedia')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>


    <!-- Modal cadastro redes -->

    <div class="modal fade" id="socialmediaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cadastre suas redes socias</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mt-4">
                    <x-jet-label for="instragram" value="{{ __('Instagram') }}" />
                    <x-jet-input id="instagram" class="block mt-1 w-full" type="text" name="instagram" :value="old('instagram')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="twitter" value="{{ __('Twitter') }}" />
                    <x-jet-input id="twitter" class="block mt-1 w-full" type="text" name="twitter" :value="old('twitter')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="tiktok" value="{{ __('Tiktok') }}" />
                    <x-jet-input id="tiktok" class="block mt-1 w-full" type="text" name="tiktok" :value="old('tiktok')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="kwai" value="{{ __('Kwai') }}" />
                    <x-jet-input id="kwai" class="block mt-1 w-full" type="text" name="kwai" :value="old('kwai')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="twitch" value="{{ __('Twitch') }}" />
                    <x-jet-input id="twitch" class="block mt-1 w-full" type="text" name="twitch" :value="old('twitch')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="facebook" value="{{ __('Facebook') }}" />
                    <x-jet-input id="facebook" class="block mt-1 w-full" type="text" name="facebook" :value="old('facebook')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="youtube" value="{{ __('Youtube') }}" />
                    <x-jet-input id="youtube" class="block mt-1 w-full" type="text" name="youtube" :value="old('youtube')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="nimo" value="{{ __('Nimo') }}" />
                    <x-jet-input id="nimo" class="block mt-1 w-full" type="text" name="nimo" :value="old('nimo')" />
                </div>

                <div class="mt-4">
                    <x-jet-label for="trovo" value="{{ __('Trovo') }}" />
                    <x-jet-input id="trovo" class="block mt-1 w-full" type="text" name="trovo" :value="old('trovo')" />
                </div>


            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </div>
      </div>

    <!-- Script de focus do modal do cadastro de redes-->
     <script>
        const myModal = document.getElementById('atualizarDadosModal')
        const myInput = document.getElementById('buttonatualizarDados')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <!-- Modal editar dados -->

    <div class="modal fade" id="atualizarDadosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Cadastre suas redes socias</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div>
                        <x-jet-label for="cnpj" value="{{ __('CNPJ') }}"/>
                        <x-jet-input id="cnpj" class="block mt-1 w-full" type="text" data-mask="00.000.000/0000-00" data-mask-clearifnomatch="true" name="cnpj" :value="old('cnpj')" onblur="checkCnpj(this.value)" required />
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
                        <input id="cpf" class="block mt-1 w-full" type="text" data-mask="000.000.000-00" data-mask-clearifnomatch="true" name="cpf" value="" onblur= "checkCpf(this.value)" required>
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
                        <x-jet-label for="birthdate" value="{{ __('
                            Data de nascimento') }}" />
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
                </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Save changes</button>
                </div>
              </div>
            </div>
          </div>

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
</x-app-layout>
</div>
