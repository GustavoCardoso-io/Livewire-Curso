<div class="container">

    @if (session('success'))
        <span class="alert alert-primary mb-3" role="alert"> {{ session('success') }} </span>
    @endif

    <form wire:submit="createNewUser" action="">

        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                wire:model.lazy="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                wire:model.lazy="email">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Senha</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                wire:model.lazy="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="form-control btn btn-success">Criar</button>

    </form>

    @foreach ($users as $user)
        <h3> {{ $user->name }} </h3>
    @endforeach

    {{ $users->links() }}

</div>
