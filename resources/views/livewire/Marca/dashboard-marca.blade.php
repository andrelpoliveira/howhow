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
        </div>
        <div class="d-flex justify-content-center">
        @foreach ($campanha as $campanhas)
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="card" style="width: 18rem;">
                    <img src={{Auth::user()->profile_photo_path}} class="card-img-top" alt="...">
                    <div class="card-body">
                            <h5 class="card-title">{{$campanhas->campaign_name}}</h5>
                    </div>
                </div>
            </div>
            
        </div>
        @endforeach
        </div>
        <!-- Botão registrar campanha -->

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CriarCampanha" id="btnCriarCampanha">Criar Campanha</button>

        <!-- Botão modal editar marca -->

        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#AtualizarMarca" id="btnAtualizarMarca">Editar Dados da Marca</button>

        <!-- Modal Campanha -->

        <div class="modal fade" id="CriarCampanha" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Alterar dados</h5>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('campanhas.store') }}">
                        @csrf

                        <div class="mt-4">
                            <label for="campaign_name" value="{{ __('Título da Campanha') }}">Título</label>/>
                            <input id="campaign_name" class="block mt-1 w-full" type="text" name="campaign_name"  :value="old('campaign_name')" required />
                        </div>

                        <div class="mt-4">
                            <label for="start_date" value="{{ __('Início') }}">Início</label>/>
                            <input id="start_date" class="block mt-1 w-full" type="date" name="start_date"  :value="old('start_date')" required />
                        </div>

                        <div class="mt-4">
                            <label for="finish_date" value="{{ __('Término') }}">Término</label>
                            <input id="finish_date" class="block mt-1 w-full" type="date" name="finish_date"  :value="old('finish_date')" required />
                        </div>
                        <div class="mt-4">
                            <label for="type" value="{{ __('Formato do evento') }}">Formato do evento</label>
                            <select id="type"  class="block mt-1 w-full" name="type" >
                                <option selected>Escolha um formato</option>
                                <option value="Sessão de fotos">Sessão de fotos</option>
                                <option value="Propaganda presencial">Propaganda presencial</option>
                                <option value="Seguimento de vídeo">Seguimento de vídeo</option>
                            </select>
                        </div>

                        <div class="mt-4">
                            <label for="funds" value="{{ __('Valor') }}">Valor</label>
                            <input id="funds" class="block mt-1 w-full" type="text" name="funds" :value="old('funds')" required />
                        </div>

                        <div class="form-text-container">
                            <label for="content" value="{{ __('Descrição') }}">Descrição</label>
                            <input id="content" class="block mt-1 w-full" type="textarea"  name="content"  :value="old('content')" required />
                        </div>

                        <div class="mt-4">
                            <label for="filter_category" value="{{ __('Categoria') }}">Categoria</label>
                            <select id="filter_category"  class="block mt-1 w-full" name="filter_category" >
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
                            <label for="filter_engagement" value="{{ __('Nível de engajamento') }}">Engajamento</label>
                            <input id="filter_engagement" class="block mt-1 w-full" type="text" name="filter_engagement"  :value="old('filter_engagement')" required />
                        </div>

                            <a href="{{'/marca/dashboard'}}" class="btn btn-secondary" >Fechar</a>

                            <button type="submit" class="btn btn-primary">Registrar Campanha</button>
                    </form>
                </div>
            </div>
          </div>
        </div>

        <!-- Modal Editar Marca -->

    <div class="modal fade" id="AtualizarMarca" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Alterar dados</h5>
            </div>
            <div class="modal-body">
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

                </form>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                  <button type="button" class="btn btn-primary">Salvar Alterações</button>
                </div>
              </div>
            </div>
          </div>

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
    <script>
        const myModal = document.getElementById('AtualizarMarca')
        const myInput = document.getElementById('btnAtualizarMarca')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>
    <script>
        const myModal = document.getElementById('CriarCampanha')
        const myInput = document.getElementById('btnCriarCampanha')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>
    </x-app-layout>
</div>
