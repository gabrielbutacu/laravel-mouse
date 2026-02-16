<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(){
        //recupero lista utenti dal database
        $users = User::get();
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
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();
        return redirect('/users');
    }

    public function delete($id){
        $user = User::find($id);
        $user->delete();
        return redirect('/users');
    }
}
