<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $users = User::query()
            ->latest()
            ->paginate($perPage = 30);

        if ($request->wantsJson()) {
            return response()->json([
                'list' => $users->map(fn (User $user) => view('users._list_row', ['user' => $user])->render())->implode(''),
                'links' => $users->links()->render(),
            ]);
        }

        return view('users.index', [
            'users' => $users,
        ]);
    }
}
