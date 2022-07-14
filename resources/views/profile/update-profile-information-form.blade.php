<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="name" value="{{ __('Name') }}" />
            <x-jet-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-jet-input-error for="name" class="mt-2" />
        </div>

        @auth('marca')
        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="cnpj" value="{{ __('cnpj') }}" />
            <x-jet-input id="cnpj" type="text" class="mt-1 block w-full" wire:model.defer="state.cnpj" autocomplete="cnpj" />
            <x-jet-input-error for="cnpj" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="corporativename" value="{{ __('corporativename') }}" />
            <x-jet-input id="corporativename" type="text" class="mt-1 block w-full" wire:model.defer="state.corporativename" autocomplete="cnpj" />
            <x-jet-input-error for="corporativename" class="mt-2" />
        </div>
        @endauth
        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="form-label" for="phone">Phone</x-jet-label>
              <x-jet-input
                type="phone"
                class="form-control"
                id="phone"
                name="phone"
                wire:model.defer="state.phone"
                placeholder="phone"
              />
         </div>

        <!-- Redes Socias -->

        <!-- Instagram -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label class="form-label" for="instagram">Instagram</x-jet-label>
              <x-jet-input
                type="instagram"
                class="form-control"
                id="instagram"
                name="instagram"
                wire:model.defer="state.instagram"
                placeholder="instagram"
              />
            </div>
            <!-- Twitter -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="twitter">Twitter</x-jet-label>
                  <x-jet-input
                    type="twitter"
                    class="form-control"
                    id="twitter"
                    name="twitter"
                    wire:model.defer="state.twitter"
                    placeholder="twitter"
                  />
            </div>
            <!-- Tiktok -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="tiktok">Tiktok</x-jet-label>
                  <x-jet-input
                    type="tiktok"
                    class="form-control"
                    id="tiktok"
                    name="tiktok"
                    wire:model.defer="state.tiktok"
                    placeholder="tiktok"
                  />
            </div>
            <!-- Kwai -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="kwai">Kwai</x-jet-label>
                  <x-jet-input
                    type="kwai"
                    class="form-control"
                    id="kwai"
                    name="kwai"
                    wire:model.defer="state.kwai"
                    placeholder="kwai"
                  />
            </div>
            <!-- Twitch -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="twitch">Twitch</x-jet-label>
                  <x-jet-input
                    type="twitch"
                    class="form-control"
                    id="twitch"
                    name="twitch"
                    wire:model.defer="state.twitch"
                    placeholder="twitch"
                  />
            </div>
            <!-- Facebook -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="facebook">Facebook</x-jet-label>
                  <x-jet-input
                    type="facebook"
                    class="form-control"
                    id="facebook"
                    name="facebook"
                    wire:model.defer="state.facebook"
                    placeholder="facebook"
                  />
            </div>
            <!-- Youtube -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="youtube">Youtube</x-jet-label>
                  <x-jet-input
                    type="youtube"
                    class="form-control"
                    id="youtube"
                    name="youtube"
                    wire:model.defer="state.youtube"
                    placeholder="youtube"
                  />
            </div>
            <!-- Nimo -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="nimo">Nimo</x-jet-label>
                  <x-jet-input
                    type="nimo"
                    class="form-control"
                    id="nimo"
                    name="nimo"
                    wire:model.defer="state.nimo"
                    placeholder="nimo"
                  />
            </div>
            <!-- Trovo -->
            <div class="col-span-6 sm:col-span-4">
                <x-jet-label class="form-label" for="trovo">Trovo</x-jet-label>
                  <x-jet-input
                    type="trovo"
                    class="form-control"
                    id="trovo"
                    name="trovo"
                    wire:model.defer="state.trovo"
                    placeholder="trovo"
                  />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! $this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button" class="underline text-sm text-gray-600 hover:text-gray-900" wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p v-show="verificationLinkSent" class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Saved.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
