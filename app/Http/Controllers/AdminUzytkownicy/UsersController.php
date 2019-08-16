<?php

namespace App\Http\Controllers\AdminUzytkownicy;

use App\Http\Requests\UpdateUsers;
use App\Users;
use App\Http\Requests\StoreUsers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;

class UsersController extends Controller
{

    protected $redirectTo = 'admin/users';

    public function index()
    {
        $users = Users::all()->sortBy("sort");
        return view('users.index',
            array('users' => $users)
        );
    }

    public function create()
    {
        return view('users.form',
            array('cardtitle' => 'Dodaj użytkownika'))
            ->with('wpis', Users::make());
    }

    public function store(StoreUsers $request)
    {
        $user = new Users();
        $user->name = $request->get('name');
        $user->email = $request->get("email");
        $user->role = $request->get('role');
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect($this->redirectTo)->with('success', 'Użytkownik dodany');
    }

    public function edit(Users $users, $id)
    {
        $user = Users::where('id', $id)->first();
        return view('users.editform',
            array(
                'wpis' => $user,
                'cardtitle' => 'Edytuj użytkownika'
            )
        );
    }

    public function password($id)
    {
        $user = Users::where('id', $id)->first();
        return view('users.passwordform',
            array(
                'wpis' => $user,
                'cardtitle' => 'Zmień hasło'
            )
        );
    }

    public function updatepassword(Request $request, $id){
        // Sprawdzamy aktualne hasło
        if (!(Hash::check($request->get('oldpassword'), Auth::user()->password))) {
            return redirect()->back()->with("error", "Twoje aktualne hasło jest inne. Spróbuj ponownie.");
        }

        // Czy na pewno zmienia hasło
        if(strcmp($request->get('oldpassword'), $request->get('password')) == 0){
            return redirect()->back()->with("error", "Nowe hasło nie może być takie samo jak bieżące. Wpisz inne hasło.");
        }

        // Walidacja formularza
        $validatedData = $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Zapisujemy hasło
        $user = Users::where('id', $id)->first();
        $user->password = Hash::make($request->get('password'));
        $user->save();

        return redirect($this->redirectTo)->with("success", "Hasło zostało zmienione");
    }

    public function update(UpdateUsers $request, $id)
    {
        $user = Users::find($id);

        $email = $request->get('email');
        $user->name = $request->get('name');
        if($email) {
            $user->email = $email;
        }
        $user->role = $request->get('role');
        $user->save();
        return redirect($this->redirectTo)->with('success', 'Dane użytkownika zaktualizowane');
    }

    public function destroy($id)
    {
        // Usuwamy pliki
        $user = Users::find($id);
        $user->delete();
        return response()->json([
            'success' => 'Wpis usniety'
        ]);
    }
}
