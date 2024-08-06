<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class ArticleController extends Controller implements HasMiddleware
{
    public function create(){
        return view('article.create');
    }

    public static function middleware() : array
    {
        return [
            new Middleware('auth', only: ['create'])
        ];
    }
}


