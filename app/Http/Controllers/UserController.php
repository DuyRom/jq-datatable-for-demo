<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function getUsersData(Request $request)
    {
        $query = User::query();

        if ($request->has('columns')) {
            foreach ($request->columns as $column) {
                if (!empty($column['search']['value'])) {
                    $query->where($column['name'], 'LIKE', '%' . $column['search']['value'] . '%');
                }
            }
        }

        return DataTables::of($query)->make(true);
    }

    public function autocomplete(Request $request)
    {
        $term = $request->get('term');
        $column = $request->get('column', 'name'); // Mặc định là 'name' nếu không có cột được chỉ định

        $results = User::where($column, 'LIKE', '%' . $term . '%')
                       ->pluck($column);

        return response()->json($results);
    }
}
