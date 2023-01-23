<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    public function index(Request $request)
    {
        $sort = $request->query('sort');

        switch ($sort) {
            case "price-high-to-low":
                $sort_main = 'price';
                $sort_arrange = 'desc';
                break;
            case "title-a-to-z":
                $sort_main = 'title';
                $sort_arrange = 'asc';
                break;
            case "title-z-to-a":
                $sort_main = 'title';
                $sort_arrange = 'desc';
                break;
            default:
                $sort_main = 'price';
                $sort_arrange = 'asc';
        }

        $search = is_null($request->query('search')) ? '' : $request->query('search');
        $status = is_null($request->query('status')) ? '' : $request->query('status');
        $provinces = is_null($request->query('provinces')) ? '' : $request->query('provinces');
        $limit = is_null($request->query('limit')) ? 25 : (int) $request->query('limit');
        $page = is_null($request->query('page')) ? 1 : (int) $request->query('page');
        $skip = ($page - 1) * $limit;

        $properties = Property::with(['province'])
            ->search($search)
            ->provinces($provinces)
            ->status($status)
            ->orderBy($sort_main, $sort_arrange);


        $properties_count = $properties->count();

        $properties_limit = $properties
            ->skip($skip)
            ->take($limit)
            ->get();

        return response()->json(['data' => $properties_limit, 'count' => $properties_count, 'status' => 'success'], 200);
    }
}
