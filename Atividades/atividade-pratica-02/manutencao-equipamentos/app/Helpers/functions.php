<?php

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Route;

if (!function_exists('data_br')) {
    function data_br($timestamp)
    {
        return Carbon::createFromFormat('Y-m-d', $timestamp)->format('d/m/Y');
    }
}

if (!function_exists('data_br_hora')) {
    function data_br_hora($timestamp)
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $timestamp)->format('d/m/Y H:i:s');
    }
}

if (!function_exists('get_tipo_registro')) {
    function get_tipo_registro($tipo)
    {
        $label = "";
        switch ($tipo) {
            case 1:
                $label = '<button class="btn btn-primary">Preventiva</button>';
                break;
            case 2:
                $label = '<button class="btn btn-warning">Corretiva</button><br>';
                break;
            case 3:
                $label = '<button class="btn btn-danger">Urgente</button><br>';
                break;
            default:
                $label = '<button class="btn btn-primary">Preventiva</button><br>';
                break;
        }
        return $label;
    }
}

if (!function_exists('menu_ativado')) {
    function menu_ativado($route)
    {
        if (strpos(Route::currentRouteName(), $route) === 0) {
            return 'active';
        } else {
            return '';
        }
    }
}

if (!function_exists('menu_open')) {
    function menu_open($route)
    {
        if (strpos(Route::currentRouteName(), $route) === 0) {
            return 'menu-open';
        } else {
            return '';
        }
    }
}
