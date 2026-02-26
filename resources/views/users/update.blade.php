<h1>Aggiorna utente</h1>
<form method="POST" action="/users/update/{{ $user->id }}">
    @csrf
    <label for="name">Nome</label>
    <input id="name" name="name" type="text" value="{{ $user->name }}" ></input>
    <br>
    <label for="email">Email</label>
    <input id="email" name="email" type="email" value="{{ $user->email }}" ></input>
    <br>
    
    <label for="city_id">Città</label>
    <select name="city_id">
        <option value="">seleziona la città...</option>
        @foreach(App\Models\City::get() as $city)
            <option value="{{$city->id}}" {{$city->id == $user->city_id ? 'selected' : ''}}>{{$city->name}}</option>
        @endforeach()
    </select>

    <br>
    <label for="roles">Ruoli</label>
    {{--
    <select name="role_id[]" multiple>
        <option value="">seleziona i ruoli...</option>
        @foreach(App\Models\Role::get() as $role)
            <option value="{{$role->id}}" >{{$role->name}}</option>
        @endforeach
    </select>
    --}}

    @foreach(App\Models\Role::get() as $role)
    <br>
        <input 
        type="checkbox" 
        value="{{$role->id}}" 
        name="role_id[]"
        {{in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : ''}}
        />
        <label>{{$role->name}}</label>

        <input type="checkbox" value="{{$role->id}}" name="role_enabled[]" />
        <label>attivo</label>
    @endforeach
<br>







    <button>Invia</button>
</form>