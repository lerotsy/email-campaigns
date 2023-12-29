<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TemplatesController extends Controller
{
    public function index(): JsonResponse
    {
        $templates = Template::all();
        return response()->json($templates);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $template = Template::create($request->all());
        return response()->json($template, 201);
    }

    public function show(Template $template): JsonResponse
    {
        return response()->json($template);
    }

    public function update(Request $request, Template $template): JsonResponse
    {
        $request->validate([
            'name' => 'string|max:255',
            'content' => 'string',
        ]);

        $template->update($request->all());
        return response()->json($template);
    }

    public function destroy(Template $template): JsonResponse
    {
        $template->delete();
        return response()->json(null, 204);
    }
}
