<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Annuler Votre Abonnement') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Êtes vous sure de vouloir annuler votre abonnement ?') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-cancel')"
    >{{ __('Annuler Votre Abonnement') }}</x-danger-button>

    <x-modal name="confirm-user-cancel" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('subscribe.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Êtes vous sure de vouloir annuler votre abonnement?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
            </p>


            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __("Annuler l'opération") }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Annuler Votre Abonnement') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
