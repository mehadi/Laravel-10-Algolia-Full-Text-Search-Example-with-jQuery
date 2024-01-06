<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\ProcessCSVData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Bus;
use Illuminate\Database\Eloquent\Builder;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $users = User::search($query)->paginate(10);

        if ($request->ajax()) {
            return response()->json(['users' => $users->toArray()]);
        }

        return view('users.index', compact('users'));
    }
}
