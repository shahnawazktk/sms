<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-3">
        @csrf
        @method('patch')

        <div class="row g-3">
            <div class="col-md-12 mb-3">
                <label for="name" class="form-label small fw-bold text-muted">{{ __('Full Name') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                    <input id="name" name="name" type="text" class="form-control @error('name') is-invalid @enderror" 
                           value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
                </div>
                @error('name')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-12 mb-3">
                <label for="email" class="form-label small fw-bold text-muted">{{ __('Email Address') }}</label>
                <div class="input-group">
                    <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                    <input id="email" name="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                           value="{{ old('email', $user->email) }}" required autocomplete="username">
                </div>
                
                @error('email')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3 border-0 shadow-sm py-2">
                        <p class="small mb-1 text-dark">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ __('Your email is unverified.') }}
                        </p>
                        <button form="send-verification" class="btn btn-link btn-sm p-0 text-decoration-none fw-bold">
                            {{ __('Click here to re-send verification.') }}
                        </button>

                        @if (session('status') === 'verification-link-sent')
                            <div class="mt-2 text-success small fw-bold">
                                {{ __('A new link has been sent!') }}
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 shadow-sm">
                <i class="fas fa-save me-2"></i>{{ __('Save Changes') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition 
                     x-init="setTimeout(() => show = false, 3000)" 
                     class="text-success small fw-bold">
                    <i class="fas fa-check-circle me-1"></i> {{ __('Changes saved successfully!') }}
                </div>
            @endif
        </div>
    </form>
</section>

<style>
    /* Input Group Styling */
    .input-group-text {
        border-radius: 10px 0 0 10px !important;
        border: 1px solid #dee2e6;
    }
    .form-control {
        border-radius: 0 10px 10px 0 !important;
        border: 1px solid #dee2e6;
        padding: 0.6rem 1rem;
    }
    .form-control:focus {
        box-shadow: none;
        border-color: #3b82f6;
    }
    .btn-primary {
        border-radius: 10px;
        padding: 0.6rem 1.5rem;
        background-color: #3b82f6;
        border: none;
    }
    .btn-primary:hover {
        background-color: #2563eb;
        transform: translateY(-1px);
    }
</style>