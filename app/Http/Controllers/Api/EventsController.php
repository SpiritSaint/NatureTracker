<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Events\DestroyRequest;
use App\Http\Requests\Api\Events\IndexRequest;
use App\Http\Requests\Api\Events\ShowRequest;
use App\Http\Requests\Api\Events\StoreRequest;
use App\Http\Requests\Api\Events\UpdateRequest;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $events = Event::query()
            ->with('device')
            ->paginate(20);

        return response()->json($events, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $event = Event::query()->create([
            "device_id" => $request->input("device_id"),
            "data" => $request->input("data"),
        ]);
        return response()->json($event, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Event $event)
    {
        $event->load('device');

        return response()->json($event, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Event $event)
    {
        $event->update([
            "data" => $request->has("data") ? $request->input("data") : $event->data,
        ]);

        return response()->json($event, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Event $event
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request, Event $event)
    {
        try {
            $event->delete();
        } catch (\Throwable $throwable) { // @codeCoverageIgnoreStart
            return response()->json(["status" => "Event Not Deleted"], 500); // @codeCoverageIgnoreEnd
        }
        return response()->json(["status" => "Event Deleted"], 200);
    }
}
