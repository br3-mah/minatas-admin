<div wire:ignore class="page-content">
    @switch($settings)
        @case('loan-parent-types')
            @include('livewire.dashboard.site-settings.__parts.loan-parent-types')
        @break
        @case('loan-categories')
            @include('livewire.dashboard.site-settings.__parts.loan-categories')
        @break    @case('loan-types')
            @include('livewire.dashboard.site-settings.__parts.loan-types')
        @break
        @case('loan-types')
            @include('livewire.dashboard.site-settings.__parts.loan-types')
        @break

        @case('loan-rates')
            @include('livewire.dashboard.site-settings.__parts.loan-rates')
        @break

        @case('loan-approval')
            @include('livewire.dashboard.site-settings.__parts.loan-approval-hierarchy')
        @break

        @case('loan-repayment-cycle')
            @include('livewire.dashboard.site-settings.__parts.loan-repayment-cycle')
        @break

        @case('loan-disbursements')
            @include('livewire.dashboard.site-settings.__parts.loan-disbursements')
        @break

        @case('loan-penalty-settings')
            @include('livewire.dashboard.site-settings.__parts.loan-penalty-settings')
        @break

        @case('loan-fees')
            @include('livewire.dashboard.site-settings.__parts.loan-fees')
        @break

        @case('loan-remainder-settings')
            @include('livewire.dashboard.site-settings.__parts.loan-remainder-settings')
        @break

        @case('loan-adjustments')
            @include('livewire.dashboard.site-settings.__parts.loan-adjustments')
        @break

        @case('send-borrower-otp')
            @include('livewire.dashboard.site-settings.__parts.send-borrower-otp')
        @break

        @case('institutes')
            @include('livewire.dashboard.site-settings.__parts.institutes')
        @break

        @case('crb')
            @include('livewire.dashboard.site-settings.__parts.crb')
        @break

        @default
            @include('livewire.dashboard.site-settings.__parts.crb')
        @break
    @endswitch

    {{-- <script>
        // Initial setup
        document.addEventListener('DOMContentLoaded', function () {
            // Set "Spooling" as the default selected option
            document.querySelector('input[name="process_type"][value="spooling"]').checked = true;
            // Display the corresponding settings
            toggleSettings('spooling');
        });

        function toggleSettings(option) {
            const settings = document.querySelectorAll('.settings');
            settings.forEach((setting) => {
                setting.style.display = 'none';
            });

            const selectedSetting = document.getElementById(option);
            selectedSetting.style.display = 'block';
        }
    </script> --}}
</div>

