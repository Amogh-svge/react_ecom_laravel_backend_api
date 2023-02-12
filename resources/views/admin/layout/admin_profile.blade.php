@extends('admin.layout.admin_layout')

@section('main_content')
    <div>
        <div class="az-dashboard-one-title">
            <div>
                <h2 class="az-dashboard-title">Hi, welcome {{ $adminData->name }}!</h2>
                <p class="az-dashboard-text">Your Profile Segement.</p>
            </div>
            <div class="az-content-header-right">
                <div class="media">
                    <div class="media-body">
                        <label>Profile created Date</label>
                        <h6>{{ Carbon::parse($adminData->created_at)->isoFormat('LL') }}</h6>
                    </div><!-- media-body -->
                </div><!-- media -->

                <a href="" class="btn btn-purple">Export</a>
            </div>
        </div><!-- az-dashboard-one-title -->
        <x-app-layout>
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Profile') }}
                </h2>
            </x-slot>


            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">

                {{-- @if ($message = Session::get('success'))
                    <h6 class=" mt-3 text-success">{{ $message }}</h6>
                @else
                    @php
                        $message = Session::get('success1');
                    @endphp
                    <h6 class=" mt-3 text-danger">{{ $message }}</h6>
                @endif --}}
                <div>
                    @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                        @livewire('profile.update-profile-information-form')
                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.update-password-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.two-factor-authentication-form')
                        </div>

                        <x-jet-section-border />
                    @endif

                    <div class="mt-10 sm:mt-0">
                        @livewire('profile.logout-other-browser-sessions-form')
                    </div>

                    @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                        <x-jet-section-border />

                        <div class="mt-10 sm:mt-0">
                            @livewire('profile.delete-user-form')
                        </div>
                    @endif
                </div>
            </div>
        </x-app-layout>
    </div>
@endsection
