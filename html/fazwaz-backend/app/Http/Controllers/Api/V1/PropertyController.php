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
                $sortMain = 'price';
                $sortArrange = 'desc';
                break;
            case "title-a-to-z":
                $sortMain = 'title';
                $sortArrange = 'asc';
                break;
            case "title-z-to-a":
                $sortMain = 'title';
                $sortArrange = 'desc';
                break;
            default:
                $sortMain = 'price';
                $sortArrange = 'asc';
        }

        $status = $request->query('status');
        $provinces = $request->query('provinces');
        $limit = (int) $request->query('limit');
        $page = (int) $request->query('page');
        $skip = ($page - 1) * $limit;

        $properties = Property::with(['province'])
            ->provinces($provinces)
            ->status($status)
            ->orderBy($sortMain, $sortArrange)
            ->skip($skip)
            ->take($limit)
            ->get();

        return response()->json(['data' => $properties, 'status' => 'success'], 200);
    }
}
