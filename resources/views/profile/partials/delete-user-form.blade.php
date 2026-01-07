<section>
    <div class="p-3 rounded-3 bg-light border border-danger border-opacity-10 mb-4">
        <div class="d-flex align-items-center">
            <div class="flex-shrink-0 bg-danger bg-opacity-10 p-3 rounded-circle me-3">
                <i class="fas fa-exclamation-triangle text-danger"></i>
            </div>
            <div>
                <p class="text-muted small mb-0">
                    {{ __('Account delete karne se aapka saara data permanently remove ho jayega. Is action ko undo nahi kiya ja sakta.') }}
                </p>
            </div>
        </div>
    </div>

    <button 
        type="button" 
        class="btn btn-outline-danger fw-bold px-4 py-2 rounded-3 shadow-sm"
        data-bs-toggle="modal" 
        data-bs-target="#confirmUserDeletionModal">
        <i class="fas fa-user-slash me-2"></i>{{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg rounded-4">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-exclamation-circle text-danger display-4"></i>
                        </div>
                        <h4 class="fw-bold text-dark">{{ __('Kiya aap waqai account delete karna chahte hain?') }}</h4>
                        <p class="text-muted mb-4 small">
                            {{ __('Tasdeeq ke liye apna password enter karein. Iske baad aapka access khatam ho jayega.') }}
                        </p>

                        <div class="text-start mb-3">
                            <label for="password" class="form-label small fw-bold text-muted">{{ __('Password') }}</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-lock text-muted"></i></span>
                                <input 
                                    id="password" 
                                    name="password" 
                                    type="password" 
                                    class="form-control @error('password', 'userDeletion') is-invalid @enderror" 
                                    placeholder="••••••••"
                                    required
                                >
                            </div>
                            @if($errors->userDeletion->has('password'))
                                <div class="text-danger small mt-2 fw-semibold">
                                    {{ $errors->userDeletion->first('password') }}
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-0 p-4 pt-0 gap-2">
                        <button type="button" class="btn btn-light px-4 py-2 rounded-3 fw-semibold flex-grow-1" data-bs-dismiss="modal">
                            {{ __('Nahi, Cancel') }}
                        </button>
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-3 fw-bold flex-grow-1">
                            {{ __('Haan, Delete Karein') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<style>
    /* Modal Design Enhancements */
    #confirmUserDeletionModal .modal-content {
        border-top: 5px solid #dc3545 !important;
    }
    
    #confirmUserDeletionModal .form-control:focus {
        border-color: #dc3545;
        box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.1);
    }

    .btn-outline-danger:hover {
        background-color: #dc3545;
        color: white;
        transform: translateY(-2px);
    }
</style>