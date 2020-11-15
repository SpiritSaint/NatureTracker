<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Devices\DestroyRequest;
use App\Http\Requests\Api\Devices\IndexRequest;
use App\Http\Requests\Api\Devices\ShowRequest;
use App\Http\Requests\Api\Devices\StoreRequest;
use App\Http\Requests\Api\Devices\UpdateRequest;
use App\Models\Device;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DevicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param IndexRequest $request
     * @return JsonResponse
     */
    public function index(IndexRequest $request)
    {
        $devices = Device::query()
            ->where('user_id', $request->user()->id)
            ->paginate(20);

        return response()->json($devices, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request)
    {
        $device = Device::query()->create([
            "user_id" => $request->user()->id,
            "name" => $request->input("name"),
            "description" => $request->has("description") ? $request->input("description") : null,
        ]);
        return response()->json($device, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param ShowRequest $request
     * @param Device $device
     * @return JsonResponse
     */
    public function show(ShowRequest $request, Device $device)
    {
        return response()->json($device, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Device $device
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, Device $device)
    {
        $device->update([
            "name" => $request->has("name") ? $request->input("name") : $device->name,
            "description" => $request->has("description") ? $request->input("description") : $device->description,
        ]);

        return response()->json($device, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param DestroyRequest $request
     * @param Device $device
     * @return JsonResponse
     */
    public function destroy(DestroyRequest $request, Device $device)
    {
        try {
            $device->delete();
        } catch (\Throwable $throwable) { // @codeCoverageIgnoreStart
            return response()->json(["status" => "Device Not Deleted"], 500); // @codeCoverageIgnoreEnd
        }
        return response()->json(["status" => "Device Deleted"], 200);
    }
}
