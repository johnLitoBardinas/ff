<div>

    <form action="POST" wire:submit.prevent="submitChangePassword">

        @livewire('form-success-error-alert')

        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save">UPDATE PASSWORD</button>
        </div>
        @csrf

        <div class="form-group">
            <small for="old_password" class="form-text text-muted">Old Password</small>
            <input type="password" class="form-control border-primary @error('oldPassword') is-invalid @enderror" aria-describedby="oldPassword" placeholder="Enter Old Password" wire:model.lazy="oldPassword"/>
            @error('oldPassword') <span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <small for="password" class="form-text text-muted">New Password</small>
            <input type="password" class="form-control border-primary @error('password_confirmation') is-invalid @enderror" aria-describedby="password_confirmation" placeholder="Password"  wire:model.lazy="password_confirmation"/>
            @error('password_confirmation') <span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        </div>

        <div class="form-group">
            <small for="password_confirmation" class="form-text text-muted">Confirm Password</small>
            <input type="password" class="form-control border-primary @error('password') is-invalid @enderror" aria-describedby="password" placeholder="Password" wire:model.lazy="password"/>
            @error('password') <span class="invalid-feedback" role="alert">{{ $message }}</span>@enderror
        </div>
    </form>

</div>
