@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ route('register') }}">
    @csrf

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-user"></i>
            </span>
            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
        </div>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="username" class="form-label">{{ __('Username') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-at"></i>
            </span>
            <input id="username" type="text" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
        </div>
        @error('username')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email Address') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-envelope"></i>
            </span>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
        </div>
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">{{ __('Password') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
            <button type="button" class="password-toggle" onclick="togglePassword('password')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
        <div class="input-group">
            <span class="input-group-text">
                <i class="fas fa-lock"></i>
            </span>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            <button type="button" class="password-toggle" onclick="togglePassword('password-confirm')">
                <i class="fas fa-eye"></i>
            </button>
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label">{{ __('Account Type') }}</label>
        <div class="d-flex gap-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="user_type" id="user-type-user" value="user" checked>
                <label class="form-check-label" for="user-type-user">
                    <i class="fas fa-user"></i> Normal User
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="user_type" id="user-type-influencer" value="influencer">
                <label class="form-check-label" for="user-type-influencer">
                    <i class="fas fa-star"></i> Influencer
                </label>
            </div>
        </div>
    </div>

    <div class="d-grid gap-2">
        <button type="submit" class="btn btn-primary">
            {{ __('Register') }}
        </button>
    </div>
</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('form').validate({
        rules: {
            name: {
                required: true,
                minlength: 2
            },
            username: {
                required: true,
                minlength: 3,
                pattern: /^[a-zA-Z0-9_]+$/
            },
            email: {
                required: true,
                email: true
            },
            password: {
                required: true,
                minlength: 8
            },
            password_confirmation: {
                required: true,
                equalTo: "#password"
            },
            user_type: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters long"
            },
            username: {
                required: "Please enter a username",
                minlength: "Username must be at least 3 characters long",
                pattern: "Username can only contain letters, numbers and underscores"
            },
            email: {
                required: "Please enter your email address",
                email: "Please enter a valid email address"
            },
            password: {
                required: "Please enter a password",
                minlength: "Password must be at least 8 characters long"
            },
            password_confirmation: {
                required: "Please confirm your password",
                equalTo: "Passwords do not match"
            },
            user_type: {
                required: "Please select an account type"
            }
        },
        errorElement: 'span',
        errorPlacement: function(error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').after(error);
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
        }
    });
});

function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const icon = input.nextElementSibling.querySelector('i');
    
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
</script>
@endpush 