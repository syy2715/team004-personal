<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

class RouteListController extends Controller
{
    public function index()
    {
        $routes = collect(Route::getRoutes())->filter(function ($route) {

            return in_array('web', $route->middleware()) && $route->uri() !== 'route-list';
        });

        return view('routes', compact('routes'));
    }
}
