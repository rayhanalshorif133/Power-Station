<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



foreach (glob(base_path('routes/api/*.php')) as $route) {
    require_once $route;
}
