<div>
    <form method="POST" wire:submit.prevent="profileSubmit">

        {{-- Alert Component Success/ Error --}}
        @livewire('form-success-error-alert')

        @csrf
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-sm btn-default border mr-2 btn__ff--primary btn-icon btn-icon__save">UPDATE PROFILE</button>
        </div>

        <div class="form-group">
            <small for="email" class="form-text text-muted">Email</small>
            <input type="text" class="form-control border-primary" aria-describedby="firstName" placeholder="Enter FirstName" value="{{ Auth::user()->email }}" disabled readonly />
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">First Name</small>
            <input type="text" class="form-control border-primary @error('firstName') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter FirstName" wire:model.lazy="firstName" />
            @error('firstName') <span class="invalid-feedback" role="alert">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Last Name</small>
            <input type="text" class="form-control border-primary @error('lastName') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter LastName" wire:model.lazy="lastName" />
            @error('lastName') <span class="invalid-feedback">{{ $message }}</span> @enderror
        </div>

        <div class="form-group">
            <small for="first_name" class="form-text text-muted">Mobile Number</small>
            <input type="text" class="form-control border-primary @error('mobileNumber') is-invalid @enderror" aria-describedby="firstName" placeholder="Enter MobileNumber" wire:model.lazy="mobileNumber" />
            @error('mobileNumber') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

    </form>
</div>
