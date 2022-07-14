<div>

    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá {{ Auth::user()->corporativename }}!
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card" style="width: 18rem;">
                    <img src={{Auth::user()->profile_photo_path}} class="card-img-top" alt="...">
                    <div class="card-body">
                      <h5 class="card-title">{{Auth::user()->brandname}}</h5>
                      <p class="card-text">{{Auth::user()->corporativename}}</p>
                      <p class="card-text">{{Auth::user()->branch}}</p>
                      <p class="card-text">{{Auth::user()->responsible}}</p>
                      <p class="card-text">{{Auth::user()->cnpj}}</p>
                      <p class="card-text">{{Auth::user()->email}}</p>
                      <p class="card-text">{{Auth::user()->phone}}</p>
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
                

             
        </div>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#influencerModal" id="buttonRegistrarInfluencer">
              inscreva um amigo no mobral 2022
            </button>
        </div>
                <!-- Modal -->
            <div class="modal fade" id="registerModalCenter" tabindex="-1" role="dialog" aria-labelledby="registerModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
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
                        <x-jet-label for="phone" value="{{ __('Telefone') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" data-mask="(00) 00000-0000" required />
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                <button type="button" class="btn btn-primary">Save changes</button>


            </div>
            </div>
            </div>
        </div>
            <script>
                $('#registerModalCenter').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
                })
            </script>

    <!-- Script de focus do modal do cadastro de influencers-->
    <script>
      const myModal = document.getElementById('influencerModal')
      const myInput = document.getElementById('buttonRegistrarInfluencer')

      myModal.addEventListener('shown.bs.modal', () => {
      myInput.focus()
      })
    </script>

    <!-- Modal registro de influencer -->
    <div class="modal fade" id="influencerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form method="POST" action="{{ route('register') }}">
              @csrf

              <div>
                  <x-jet-label for="cnpj" value="{{ __('CNPJ') }}" />
                  <x-jet-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')" onblur="checkcnpj(this.value)" required />
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
                  <x-jet-input id="genre" class="block mt-1 w-full" type="text" name="genre" :value="old('genre')" required />
              </div>
              <div class="mt-4">
                  <x-jet-label for="phone" value="{{ __('Telefone') }}" />
                  <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
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

      <!-- Editar dados de agencia -->
      <script>
        const myModal = document.getElementById('atualizarDadosModal')
        const myInput = document.getElementById('buttonatualizarDados')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <!-- Botão chamada modal Cadastro -->

    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#atualizarDadosModal" id="buttonatualizarDados">Editar Dados da Empresa</button>

    <!-- Modal editar dados agência -->

    <div class="modal fade" id="atualizarDadosModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Alterar dados</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mt-4">
                        <label for="cnpj">{{__('CNPJ')}}</label>
                        <input id="cnpj" class="block mt-1 w-full" type="text" data-mask="00.000.000/0000-00" data-mask-clearifnomatch="true" name="cnpj" value="old('cnpj')" onblur="checkCnpj(this.value)"  required>
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="corporativename" value="{{ __('Nome da Agência') }}" />
                        <x-jet-input id="corporativename" class="block mt-1 w-full" type="text" name="corporativename" :value="old('corporativename')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="fantasyname" value="{{ __('Nome Fantasia') }}" />
                        <x-jet-input id="fantasyname" class="block mt-1 w-full" type="text" name="fantasyname" :value="old('fantasyname')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="responsible" value="{{ __('Responsável') }}" />
                        <x-jet-input id="responsible" class="block mt-1 w-full" type="text" name="responsible" :value="old('responsible')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password" value="{{ __('Senha') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirme a senha') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="branch" value="{{ __('
                            Ramo') }}" />
                        <x-jet-input id="branch" class="block mt-1 w-full" type="text" name="branch" :value="old('branch')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="email" value="{{ __('E-mail') }}" />
                        <x-jet-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required />
                    </div>

                    <div class="mt-4">
                        <x-jet-label for="phone" value="{{ __('Telefone') }}" />
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" data-mask="(00) 00000-0000" required />
                    </div>

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
