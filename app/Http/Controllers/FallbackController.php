<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class FallbackController extends Controller
{
    public function __invoke()
    {
        Return view('fallback.index');        
    }
}