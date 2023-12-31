<?php

namespace App\Http\Controllers;

use App\Jobs\SendBatchEmailsJob;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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

    public function launch(Request $request, Campaign $campaign)
    {
        $request->validate([
            'status' => [
                'required',
                'not_in:' . implode(',', [Campaign::STATUS_SENT, Campaign::STATUS_DRAFT]),
            ],
        ]);

        try {
            SendBatchEmailsJob::dispatch($campaign->id);

            $campaign->status = Campaign::STATUS_SENT;
            $campaign->save();

            return response()->json(['message' => 'Campaign launched successfully', 'campaign' => $campaign]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to launch the campaign'], 500);
        }
    }
}
