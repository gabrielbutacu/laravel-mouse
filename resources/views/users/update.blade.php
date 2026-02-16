<h1>Aggiorna utente</h1>
<form method="POST" action="/users/update/{{ $user->id }}">
    @csrf
    <label for="name">Nome</label>
    <input id="name" name="name" type="text" value="{{ $user->name }}" ></input>
    <br>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ $user->email }}" ></input>

    <button>Invia</button>
</form>