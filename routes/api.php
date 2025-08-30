<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PacienteController;

Route::apiResource('pacientes', PacienteController::class);
