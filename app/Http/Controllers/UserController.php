<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use App\Traits\DataTableTrait;

class UserController extends Controller
{
    use DataTableTrait;

    public function index()
    {
        return view('users.index');
    }

    public function getUsersData(Request $request)
    {
        return $this->getData($request, User::class);
    }

    public function autocomplete(Request $request)
    {
        return $this->autocompleteData($request, User::class);
    }
}
