<section>
    <form method="post" action="{{ route('password.update') }}" class="mt-3">
        @csrf
        @method('put')

        <div class="row g-3">
            <div class="col-md-12 mb-3">
                <label for="update_password_current_password" class="form-label small fw-bold text-muted">{{ __('Current Password') }}</label>
                <div class="input-group shadow-sm border rounded-3 overflow-hidden">
                    <span class="input-group-text bg-light border-0"><i class="fas fa-lock-open text-muted small"></i></span>
                    <input id="update_password_current_password" name="current_password" type="password" 
                           class="form-control border-0 @error('current_password', 'updatePassword') is-invalid @enderror" 
                           autocomplete="current-password" placeholder="••••••••">
                </div>
                @if($errors->updatePassword->has('current_password'))
                    <div class="text-danger small mt-2 fw-semibold">
                        <i class="fas fa-exclamation-triangle me-1"></i> {{ $errors->updatePassword->first('current_password') }}
                    </div>
                @endif
            </div>

            <div class="row g-3 px-0 mx-0">
                <div class="col-md-6 mb-3">
                    <label for="update_password_password" class="form-label small fw-bold text-muted">{{ __('New Password') }}</label>
                    <div class="input-group shadow-sm border rounded-3 overflow-hidden">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-key text-muted small"></i></span>
                        <input id="update_password_password" name="password" type="password" 
                               class="form-control border-0 @error('password', 'updatePassword') is-invalid @enderror" 
                               autocomplete="new-password" placeholder="Enter new password">
                    </div>
                    @if($errors->updatePassword->has('password'))
                        <div class="text-danger small mt-2 fw-semibold">
                             {{ $errors->updatePassword->first('password') }}
                        </div>
                    @endif
                </div>

                <div class="col-md-6 mb-3">
                    <label for="update_password_password_confirmation" class="form-label small fw-bold text-muted">{{ __('Confirm Password') }}</label>
                    <div class="input-group shadow-sm border rounded-3 overflow-hidden">
                        <span class="input-group-text bg-light border-0"><i class="fas fa-shield-alt text-muted small"></i></span>
                        <input id="update_password_password_confirmation" name="password_confirmation" type="password" 
                               class="form-control border-0 @error('password_confirmation', 'updatePassword') is-invalid @enderror" 
                               autocomplete="new-password" placeholder="Repeat new password">
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-sm fw-bold">
                <i class="fas fa-sync-alt me-2"></i>{{ __('Update Security Key') }}
            </button>

            @if (session('status') === 'password-updated')
                <div x-data="{ show: true }" 
                     x-show="show" 
                     x-transition 
                     x-init="setTimeout(() => show = false, 3000)" 
                     class="text-success small fw-bold animate__animated animate__fadeIn">
                    <i class="fas fa-shield-check me-1"></i> {{ __('Security updated successfully.') }}
                </div>
            @endif
        </div>
    </form>
</section>

<style>
    /* Security Form Enhancements */
    .input-group:focus-within {
        border-color: #3b82f6 !important;
        box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1) !important;
    }
    
    .form-control::placeholder {
        color: #cbd5e1;
        font-size: 0.9rem;
    }

    .btn-primary {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border: none;
        transition: transform 0.2s ease;
    }

    .btn-primary:active {
        transform: scale(0.95);
    }
</style>