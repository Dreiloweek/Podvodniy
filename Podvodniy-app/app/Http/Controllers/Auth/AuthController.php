<?php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use function Laravel\Prompts\error;

class AuthController extends Controller
{

    public function login(Request $request): \Illuminate\Http\JsonResponse
    {

        $validated = $request->validate([

            'username' => 'required|string',
            'password' => 'required|string',
        ]);
        if (!Auth::attempt($validated)) {
            return response()->json(['error' => 'Неверный логин или пароль'], 422);
        }
        return response()->json(['success' => 'Вход успешен'], 200);
    }



    public function logout(): RedirectResponse
    {
        auth()->logout();
        return redirect()->route('/'); // Или перенаправление на другую страницу
    }
    public function showLoginForm(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('auth.login', ['isAuthenticated' => auth()->check()]);
    }
    public function index(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        $users = User::all();

        return view('profile/admin', compact('users'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|integer',
            'username' => 'required|string',
            'role' => 'required|string',
        ]);

        $user = User::findOrFail($request->id);
        $user->username = $request->username;
        $user->role = $request->role;
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Пользователь обновлен!');
    }
    public function destroy(Request $request)
    {
        $id = $request->input('id'); // Получаем ID из POST-запроса
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Пользователь удален!');
    }


    public function show($id): \Illuminate\Http\JsonResponse
    {
        $user = User::findOrFail($id);
        return response()->json($user);  // Возвращаем данные пользователя в формате JSON
    }
}
