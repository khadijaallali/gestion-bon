<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller

{
    public function __construct()
    {
        $this->middleware('auth');
    }

public function index()
{
    $users = User::all();
    return view('users.index', compact('users'));
}

public function create()
{
    return view('users.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6|confirmed',
        'password_confirmation' => 'required|string|min:6',
        'role' => 'required|in:admin,user',
    ]);
    $validated['password'] = bcrypt($validated['password']);
    User::create($validated);
    return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
}

public function edit($id)
{
    $user = User::findOrFail($id);
    return view('users.edit', compact('user'));
}

public function update(Request $request, $id)
{
    $user = User::findOrFail($id);
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        // Ajoute d'autres champs si besoin
    ]);
    $user->update($validated);
    return redirect()->route('users.index')->with('success', 'Utilisateur modifié.');
}

}