<form method="POST" action="/users/create">
    @csrf
    <label for="name">Nome</label>
    <input id="name" name="name" type="text"></input>
    <br>
    <label for="email">Email</label>
    <input id="email" name="email" type="email"></input>

    <button>Invia</button>
</form>