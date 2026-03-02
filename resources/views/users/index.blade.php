<h1>Lista utenti</h1>
<br>
<form>
<input type="text" name="search_name" value="{{ Request::get('search_name') }}" placeholder="Ricerca per nome..." />
<input type="text" name="search_email" value="{{ Request::get('search_email') }}" placeholder="Ricerca per email..." />
<button>Ricerca</button>
</form>
<br><a href="/users">Resetta parametri</a>
<br>
<a href="/users/create">Crea nuovo utente</a>
<br>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Città</th>
            <th>Azioni</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($users as $user)
            <tr>
            
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>{{$user->city->name ?? 'N.D.'}}</td>
                <td>
                    @foreach($user->roles->pluck('pivot.enabled', 'name') as $roleName => $roleEnabled)
                    {{$roleName}}:{{$roleEnabled}}<br>
                    @endforeach
                </td>
                <td>
                    <a href="/users/update/{{ $user->id }}">Modifica</a>
                    <form method="POST" action="/users/delete/{{ $user->id }}">
                        <input type="hidden" name="_method" value="delete" />
                        @csrf
                        <button>Elimina</button>
                    </form>
                </td>
            </tr>
        @endforeach
        
    </tbody>
</table>