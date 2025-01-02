<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

trait DataTableTrait
{
    public function getData(Request $request, $model)
    {
        $query = $model::query();

        if ($request->has('columns')) {
            foreach ($request->columns as $column) {
                if (!empty($column['search']['value'])) {
                    $query->where($column['name'], 'LIKE', '%' . $column['search']['value'] . '%');
                }
            }
        }

        return DataTables::of($query)->make(true);
    }

    public function autocompleteData(Request $request, $model)
    {
        $term = $request->get('term');
        $column = $request->get('column', 'name'); 

        $results = $model::where($column, 'LIKE', '%' . $term . '%')
                         ->pluck($column);
        
        return response()->json($results);
    }
}
