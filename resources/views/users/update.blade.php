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
        class="role-id"
        id="role_id_{{$role->id}}"
        {{in_array($role->id, $user->roles->pluck('id')->toArray()) ? 'checked' : ''}}
        />
        <label>{{$role->id.': '.$role->name}}</label>

        <input 
            type="checkbox" 
            value="{{$role->id}}" 
            name="role_enabled[]" 
            id="role_enabled_{{$role->id}}"
            {{ $user->roles->find($role->id) && $user->roles->find($role->id)->pivot->enabled ? 'checked' : '' }}
            />
        <label>attivo</label>
    @endforeach
<br>
    <button>Invia</button>
</form>

<script>
/*
    document.getElementById("role_id_1").addEventListener('change', function(){
        console.log("on change");
        let checked = document.getElementById('role_id_1').checked;
        if(checked){
            document.getElementById("role_enabled_1").removeAttribute("disabled");
        }else{
            document.getElementById("role_enabled_1").setAttribute("disabled", true);
        }
    });
*/

let roleIdLength = document.getElementsByClassName("role-id").length;
for(let i=0; i < roleIdLength; i++){
    let roleIdInput = document.getElementsByClassName("role-id")[i];
    roleIdInput.addEventListener('change', function(){
        console.log("on change");
        let checked = roleIdInput.checked;
        //split genera un array dividendo la stringa tante volte quante volte trova il carattere _
        //let roleId = roleIdInput.id.split('_')[2];
        let roleId = roleIdInput.id.substr(8);
        console.log("roleId: ", roleId);
        if(checked){
            document.getElementById("role_enabled_"+roleId).removeAttribute("disabled");
        }else{
            document.getElementById("role_enabled_"+roleId).setAttribute("disabled", true);
        }
    });
}

</script>