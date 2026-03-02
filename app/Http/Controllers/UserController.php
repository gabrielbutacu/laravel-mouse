<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        //recupero lista utenti dal database
        $users = User::where(function($query) use ($request){
                if($request->input('search_name')){
                    $query->where('name', 'LIKE', '%'.$request->input('search_name').'%');
                }
                if($request->input('search_email')){
                    $query->where('email', 'LIKE', '%'.$request->input('search_email').'%');
                }
            })
            ->get();
            /*
        if($request->input('search_name') || $request->input('search_email')){
            
            //ricerca con where name = ?
            //$users = User::where('name', '=', $request->input('search'))
            //->get();
            
            
            
            //where con 2 parametri
            //$users = User::where('name', $request->input('search'))
            //->get();
            
             //ricerca con where like
            $users = User::where(function($query){
                if($request->input('search_name')){
                    $query->where('name', 'LIKE', $request->input('search_name'));
                }
                if($request->input('search_email')){
                    $query->orWhere('email', 'LIKE', $request->input('search'));
                }
            })
            ->get();
        }else{
            $users = User::get();
        }
        */
        /*
        //creo un array e inserisco due utenti hard coded
        $users = [];
        $user1 = new User();
        $user1->name = 'Mario Rossi';
        $users[] = $user1;

        $user2 = new User();
        $user2->name = 'Giovanni Verdi';
        $users[] = $user2;
        */
        //aggiungiamo un elemento all'interno dell'array $users
        //$users[] = 'prova';
        //$users[] = 'prova 2';
        //$users[] = 'prova 3';

        //$users[1] = 'ciao';

        //$user = [];
        //$user['first_name'] = 'Mario';
        //$user['last_name'] = 'Rossi';

        //var_dump è una funzione nativa di PHP
        //var_dump($user);
        //return true;
        //dd fa il dump del parametro fermando l'esecuzione del codice
        //dd($user);

        //dump fa la stessa cosa del dd ma non ferma l'esecuzione del codice
        //dump($user);

        //1° modalità di passaggio di parametri alla view 
        // attraverso un array associativo 
        /*
        return view('users.index', [
            'users' => $users
        ]);
        */

        //2° modalità di passaggio di parametri alla vie
        // attraverso la funzione compact

        return view('users.index', compact('users'));

    }

    public function create(){
        return view('users.create');
    }

    public function save(Request $request){
        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = 'password';
        $user->save();

        return redirect('/users');

    }

    public function update($id){
        //$user = User::where('id', '=', $id)->get()[0];
        $user = User::find($id);
        if($user == null){
            //return view con array più comodo in questo caso
            return view('error', [
                'link' => '/users',
                'error' => 'Utente inesistente'
            ]);
            //return view con compact, più macchinoso e ridondante
            /*
            $error = 'Utente inesistente';
            $link = '/users';
            return view('error', compact('error', 'link'));
            */
        }
        return view('users.update', compact('user'));
    }

    public function saveUpdate($id, Request $request){
        $user = User::find($id);
        //dd($request->all());
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->city_id = $request->input('city_id');
        //attach inserisce nella tabella pivot 
        // senza tenere conto di quello che c'è già
        //$user->roles()->attach($request->input('role_id'));
        //sync inserisce o toglie dalla tabella pivot per mantenere solo le righe con id indicati
        //senza ulteriori campi nella tabella pivot basta un array di id
        //esempio di role_id: [1, 2, 3]
        //$user->roles()->sync($request->input('role_id'));
        //con altri campi invece deve essere un array chiave ID , valore array di proprietà, ad esempio enabled => 1
        /*
        [
            1 => [
                'enabled' => 1
            ],
            2 => 
            [
                'enabled' => 0
            ]
        ]
            */
        $userRoles = [];
        foreach($request->input('role_id') as $roleId){
            $enabled = 0;
            if( is_array($request->input('role_enabled')) &&  in_array($roleId, $request->input('role_enabled')) ){
                $enabled = 1;
            }
            $userRoles[$roleId] = [
                'enabled' => $enabled
            ];
        } 
        //dd($userRoles);
        //syncWithoutDetaching sincronizza i ruoli passati come parametro 
        //senza togliere quelli esistenti ma non presenti nel parametro 
        $user->roles()->syncWithoutDetaching($userRoles);

        $user->save();
        return redirect('/users');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
}
