<h1>Lista utenti</h1>
<br>
<a href="/users/create">Crea nuovo utente</a>
<br>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
            
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    <a href="/users/update/{{ $user->id }}">Modifica</a>
                    <form method="POST" action="/users/delete/{{ $user->id }}">
                        <input type="hidden" name="_method" value="delete" />
                        <button>Elimina</button>
                    </form>
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>