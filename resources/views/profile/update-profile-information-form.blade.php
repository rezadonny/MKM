<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Name') }}" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model="state.name" required
                autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required
                autocomplete="username" />
            <x-input-error for="email" class="mt-2" />

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                    !$this->user->hasVerifiedEmail())
                <p class="text-sm mt-2">
                    {{ __('Your email address is unverified.') }}

                    <button type="button"
                        class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        wire:click.prevent="sendEmailVerification">
                        {{ __('Click here to re-send the verification email.') }}
                    </button>
                </p>

                @if ($this->verificationLinkSent)
                    <p class="mt-2 font-medium text-sm text-green-600">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('Phone') }}" />
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model="state.phone" required
                autocomplete="phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('Address') }}" />
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model="state.address" required
                autocomplete="address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <!-- Gender -->
        {{--         <div class="col-span-6 sm:col-span-4">
            <x-label for="gender" value="{{ __('Gender') }}" />
            <x-input id="gender" type="text" class="mt-1 block w-full" wire:model="state.gender" required
                autocomplete="gender" />
            <x-input-error for="gender" class="mt-2" />
        </div> --}}

        <div class="col-span-6 sm:col-span-4">
            <x-label for="gender" class="mt-1 block w-full">Gender</x-label>
            <select name="gender" value="{{ __('Gender') }}" wire:model="state.gender" required
                autocomplete="gender">
                <option value="Male" selected>Male</option>
                <option value="Female">Female</option>
            </select>
        </div>

        <!-- Position -->
        {{--         <div class="col-span-6 sm:col-span-4">
            <x-label for="position" value="{{ __('Position') }}" />
            <x-input id="position" type="text" class="mt-1 block w-full" wire:model="state.position" required
                autocomplete="position" />
            <x-input-error for="position" class="mt-2" />
        </div> --}}

        <div class="col-span-6 sm:col-span-4">
            <x-label for="position" class="mt-1 block w-full">Position</x-label>
            <select name="position" value="{{ __('Position') }}" wire:model="state.position" required
                autocomplete="position">
                <option value="Registrar" selected>Registrar</option>
                <option value="Kurator">Kurator</option>
                <option value="Konservator">Konservator</option>
                <option value="Edukator">Edukator</option>
                <option value="Penata Pameran">Penata Pameran</option>
                <option value="Humas">Humas</option>
                <option value="Pemasaran">Pemasaran</option>
            </select>
        </div>

        <!-- Agency -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="agency" value="{{ __('Agency') }}" />
            <x-input id="agency" type="text" class="mt-1 block w-full" wire:model="state.agency" required
                autocomplete="agency" />
            <x-input-error for="agency" class="mt-2" />
        </div>

        <!-- Comment -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="comment" value="{{ __('Comment') }}" />
            <x-input id="comment" type="text" class="mt-1 block w-full" wire:model="state.comment" required
                autocomplete="comment" />
            <x-input-error for="comment" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
