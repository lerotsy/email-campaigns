<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class CampaignsController extends Controller
{
    /**
     * Display a listing of all campaigns.
     *
     * @return JsonResponse A JSON response containing all campaigns.
     */
    public function index(): JsonResponse
    {
        $campaings = Campaign::all();
        return response()->json($campaings);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'template_id' => 'nullable|exists:templates,id',
            'name' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'status' => 'required|string|in:draft,scheduled,sent',
        ]);
        
        $campaign = Campaign::create($request->all());
        return response()->json($campaign, 201);
    }

    public function show(Campaign $campaign)
    {
        return response()->json($campaign);
    }

    public function update(Request $request, Campaign $campaign)
    {
        $request->validate([
            'template_id' => 'nullable|exists:templates,id',
            'name' => 'string|max:255',
            'subject' => 'string|max:255',
            'content' => 'nullable|string',
            'scheduled_at' => 'nullable|date',
            'status' => 'string|in:draft,scheduled,sent',
        ]);

        $campaign->update($request->all());
        return response()->json($campaign);
    }

    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
        return response()->json(null, 204);
    }

    public function schedule(Request $request, Campaign $campaign)
    {
        $request->validate([
            'scheduled_at' => 'required|date|after:now',
        ]);

        $campaign->scheduled_at = $request->scheduled_at;
        $campaign->status = 'scheduled';
        $campaign->save();

        // TODO handle with transaction
        // dispatch(new ScheduleCampaignJob($campaign));

        return response()->json(['message' => 'Campaign scheduling initiated', 'campaign' => $campaign]);
    }
}
