@extends('layouts.app',['title' => 'Profile Admin'])
@section('content')
    <div class="container-fluid">

        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                <div class="alert alert-success alert-dismissible show fade">
                    <div class="alert-body">
                        <button class="close" data-dismiss="alert">
                            <span>&times;</span>
                        </button>
                        @if (session('status')=='profile-information-updated')
                            Profile Has Been updated !!
                        @endif
                        @if (session('status')=='password-updated')
                            Password has been Updated !!
                        @endif
                        @if (session('status')=='two-factor-authentication-enabled')
                            Two faktor authentication enabled !!
                        @endif
                        @if (session('status')=='recovery-codes-generated')
                            Recovery codes generated !!
                        @endif
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- page Heading --}}
        <div class="row">
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::twoFactorAuthentication()))
            <div class="col-md-5 mb-5">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold">
                            <i class="fas fa-key"></i>
                            TWO-FAKTOR AUTHENTICATION
                        </h6>
                    </div>
                    <div class="card-body">
                        @if(! auth()->user()->two_factor_secret)
                        {{-- Enable 2FA --}}
                        <form action="{{ url('user/two-factor-authentication') }}" method="POST">
                            @csrf
                            <button class="btn btn-primary text-uppercase" type="submit">
                                Enabled Two-Faktor
                            </button>
                        </form>
                        @else
                        {{-- DIsabled 2FA --}}
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mb-3 text-uppercase">
                                Disable Two Faktor
                            </button>
                        </form>
                        @if (session('status') == 'two-factor-authentication-enabled')
                        {{-- Show SVG Qr Code, After Enabling 2FA --}}
                            <p>
                                Otentikasi dua faktor sekarang diaktifkan, Pindai kode Qr Berikut menggunakan apliasi 

                            </p>
                            <div class="mb-3">
                                 {!! auth()->user()->twoFactorQrCodeSvg() !!}
                            </div>
                        @endif
                        {{-- Show 2FA Recovery Codes --}}
                        <p>
                            Simpan recovery code ini  dengan aman. Ini dapat digunakan untuk memulihkan akses ke akun Anda jika perangkat otentikasi dua faktor Anda hilang.
                        </p>
                        <div style="background: rgb(44, 44, 44);color:white" class="rounded p-3 mb-2">
                        @foreach (json_decode(decrypt(auth()->user()->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                        @endforeach
                            </div>
                            {{-- Regenerate 2FA Recovery Codes --}}
                            <form method="POST" action="{{ url('user/two-factor-recovery-codes') }}">
                                @csrf

                                <button type="submit" class="btn btn-dark text-uppercase">
                                    Regenerate Recovery Codes
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            <div class="col-md-7">
                <div class="card border-0 shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-user-circle"></i> EDIT PROFILE</h6>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user-profile-information.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="text-uppercase">Nama</label>
                                <input type="text" class="form-control" name="name"
                                    value="{{ old('name') ?? auth()->user()->name }}" required autofocus
                                    autocomplete="name" />
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">Email</label>
                                <input type="email" name="email" class="form-control"
                                    value="{{ old('email') ?? auth()->user()->email }}" required autofocus />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary text-uppercase" type="submit">
                                    Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card border-0 shadow mt-3 mb-4">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold"><i class="fas fa-unlock"></i> UPDATE PASSWORD</h6>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('user-password.update') }}">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label class="text-uppercase">Current Password</label>
                                <input type="password" class="form-control" name="current_password" required
                                    autocomplete="current-password" />
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">Password</label>
                                <input type="password" name="password" required autocomplete="new-password"
                                    class="form-control" />
                            </div>
                            <div class="form-group">
                                <label class="text-uppercase">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" required
                                    autocomplete="new-password" />
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary text-uppercase" type="submit">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection