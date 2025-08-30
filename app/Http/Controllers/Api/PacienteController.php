<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePacienteRequest;
use App\Http\Requests\UpdatePacienteRequest;
use App\Http\Resources\PacienteResource;
use App\Models\Paciente;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 10);
        $items = Paciente::query()->latest('_id')->paginate($perPage);

        return response()->json([
            'data' => PacienteResource::collection($items),
            'meta' => [
                'current_page' => $items->currentPage(),
                'per_page' => $items->perPage(),
                'total' => $items->total(),
            ],
        ]);
    }

    public function show(string $id): JsonResponse
    {
        $paciente = Paciente::findOrFail($id);
        return response()->json(['data' => new PacienteResource($paciente)]);
    }

    public function store(StorePacienteRequest $request): JsonResponse
    {
        $paciente = Paciente::create($request->validated());
        return response()->json(['data' => new PacienteResource($paciente)], 201);
    }

    public function update(UpdatePacienteRequest $request, string $id): JsonResponse
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->fill($request->validated())->save();
        return response()->json(['data' => new PacienteResource($paciente)]);
    }

    public function destroy(string $id): JsonResponse
    {
        $paciente = Paciente::findOrFail($id);
        $paciente->delete();
        return response()->json([], 204);
    }
}
