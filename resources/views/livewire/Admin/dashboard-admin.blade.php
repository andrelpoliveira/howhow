<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Olá Admin!
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                @foreach($influencer as $influencers)
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{$influencers->name}}</h5>
                        <p class="card-text">{{$influencers->name_artistic}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">{{$influencers->email}}</li>
                        <li class="list-group-item">{{$influencers->phone}}</li>
                        <li class="list-group-item">{{$influencers->birthdate}}</li>
                        <li class="list-group-item">{{$influencers->genre}}</li>
                        <li class="list-group-item">{{$influencers->agency}}</li>
                        </ul>
                        <div class="card-body">
                        <a href="#" class="card-link">{{$influencers->instagram}}</a>
                        <a href="#" class="card-link">{{$influencers->twitter}}</a>
                        <a href="#" class="card-link">{{$influencers->tiktok}}</a>
                        <a href="#" class="card-link">{{$influencers->kwai}}</a>
                        <a href="#" class="card-link">{{$influencers->facebook}}</a>
                        <a href="#" class="card-link">{{$influencers->youtube}}</a>
                        <a href="#" class="card-link">{{$influencers->twitch}}</a>
                        <a href="#" class="card-link">{{$influencers->nimo}}</a>
                        <a href="#" class="card-link">{{$influencers->trovo}}</a>
                        </div>
                    </div>
                @endforeach

                @foreach($agencia as $agencias)
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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

                @foreach($marca as $marcas)
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
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

                @foreach($campanha as $campanhas)
                    <div class="card" style="width: 18rem;">
                        <img src="..." class="card-img-top" alt="...">
                        <div class="card-body">
                        <h5 class="card-title">{{$campanha->campaign_name}}</h5>
                        <p class="card-text">{{$campanha->content}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                        <li class="list-group-item">Data de inicio: {{$campanhas->start_date}}</li>
                        <li class="list-group-item">Data de termino: {{$campanhas->finish_date}}</li>
                        <li class="list-group-item">Tipo de campanha: {{$campanha->type}}</li>
                        <li class="list-group-item">Dindin: {{$campanha->funds}}</li>
                        </ul>
                        <div class="card-body">
                        <a href="#" class="card-link">Se candidatar a campanha</a>
                        </div>
                    </div>
                @endforeach
            
            </div>  



            
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#influencerModal" id="buttonInfluencer">
                inscreva um amigo no mobral 2022
            </button>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agenciaModal" id="buttonAgencia">
                registrar agência
            </button>

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#marcaModal" id="buttonMarca">
                registrar marca
            </button>

        </div>
    
        
    </x-app-layout>
    
    
    <!-- Checagem de CPF -->
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
                        Console.log(data);
                        document.getElementById('corporativename').value = data.nome;
                        document.getElementById('brandname').value = data.fantasia;
                    }
                }
            });
        }
    </script>


    <!-- Script de focus do modal do influenciador-->
    <script>
        const myModal = document.getElementById('influencerModal')
        const myInput = document.getElementById('buttonInfluencer')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

     <!-- Script de focus do modal do agência-->
     <script>
        const myModal = document.getElementById('agenciaModal')
        const myInput = document.getElementById('buttonAgencia')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <!-- Script de focus do modal do Marca-->
    <script>
        const myModal = document.getElementById('marcaModal')
        const myInput = document.getElementById('buttonMarca')

        myModal.addEventListener('shown.bs.modal', () => {
        myInput.focus()
        })
    </script>

    <!-- Modal Marca -->
    <div class="modal fade" id="marcaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registre uma marca</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register.marca') }}">
                    @csrf
    
                    <div>
                        <x-jet-label for="cnpj" value="{{ __('CNPJ') }}" />
                        <x-jet-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')" onblur="checkCNPJ(this.value)" required />
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
                        <x-jet-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')" required />
                    </div>
    
                    <div class="mt-4">
                        <x-jet-label for="responsible" value="{{ __('Responsável') }}" />
                        <x-jet-input id="responsible" class="block mt-1 w-full" type="text" name="responsible" :value="old('responsible')" required />
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




    <!-- Modal Agência -->
    <div class="modal fade" id="agenciaModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" >Registre uma agência</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('register.agencia') }}">
                    @csrf
                    
                    <div>
                        <x-jet-label for="cnpj" value="{{ __('CNPJ') }}" />
                        <x-jet-input id="cnpj" class="block mt-1 w-full" type="text" name="cnpj" :value="old('cnpj')" onblur="checkCNPJ(this.value)" required />
                    </div>
                    
                    <div>
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





    <!-- Modal Influencer -->
    <div class="modal fade" id="influencerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Inscrição para o Mobral 2022</h5>
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
    
</div>
