<x-jet-form-section submit="updatePassword" style="text-align: right;">
    <x-slot name="title">
        تعديل كلمه السر
    </x-slot>

    <x-slot name="description">
        تأكد من أن حسابك يستخدم كلمة مرور طويلة وعشوائية للبقاء آمنًا.
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="current_password" value="الرقم السري الحالي" />
            <x-jet-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-jet-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password" value="الرقم السري الجديد" />
            <x-jet-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-jet-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="password_confirmation" value="تاكيد الرقم السري الجديد" />
            <x-jet-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-jet-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            تم الحفظ
        </x-jet-action-message>

        <x-jet-button>
            حفظ
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
