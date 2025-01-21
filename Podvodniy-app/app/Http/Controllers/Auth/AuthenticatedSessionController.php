<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
// Метод отображения формы входа
public function create(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
{
return view('auth.login');
}

// Метод обработки данных при входе
public function store(Request $request): \Illuminate\Http\RedirectResponse
{
$validated = $request->validate([
'username' => 'required|string',
'password' => 'required|string',
]);

if (Auth::attempt($validated)) {
$request->session()->regenerate();

return redirect()->route('home');
}

throw ValidationException::withMessages([
'username' => ['The provided credentials are incorrect.'],
]);
}

// Метод для выхода из системы
public function destroy(Request $request): \Illuminate\Http\RedirectResponse
{
Auth::logout();

$request->session()->invalidate();
$request->session()->regenerateToken();

return redirect()->route('home');
}
}
