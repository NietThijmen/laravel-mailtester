<div>
    <form
        wire:submit.prevent="save"
    >
        <flux:input
            type="text"
            name="username"
            label="{{ __('Username') }}"
            placeholder="{{ __('Enter your username') }}"
            wire:model.defer="username"
            required/>

        <flux:input
            type="password"
            name="password"
            label="{{ __('Password') }}"
            placeholder="{{ __('Enter your password') }}"
            wire:model.defer="password"
            required/>

        <flux:button
            type="submit"
            label="{{ __('Create Account') }}"
            class="mt-4"
            icon="plus">
            {{ __('Create Account') }}
        </flux:button>

        <span x-data="{shown: false}" x-show="shown" x-transition
              x-on:saved-account="shown = true">
            {{ __('Account created successfully!') }}
        </span>
    </form>
</div>
