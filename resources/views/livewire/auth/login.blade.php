@section('title', 'Login')

<div>
    <form wire:submit.prevent="login">
        <div class="form-group first">
            <label for="username">Username</label>
            <input type="text" wire:model="username" class="form-control @error('username') is-invalid @enderror" placeholder="Username" id="username">
            @error('username')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <div class="form-group last mb-3">
            <label for="password">Password</label>
            <input type="password" wire:model="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" id="password">
            @error('password')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
        <input type="submit" value="Log In" class="btn btn-block btn-secondary">
    </form>
</div>
