<?php

namespace App\Api\V1\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use App\Api\V1\Http\Requests\Notification\NotificationRequest;
use App\Api\V1\Repositories\Notification\NotificationRepositoryInterface;
use App\Api\V1\Services\Notification\NotificationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Notifications
 */
class NotificationController extends Controller
{
    protected $repositoryNote;
    public function __construct(
        NotificationRepositoryInterface $repository,
        NotificationServiceInterface $service
    ) {
        $this->repositoryNote = $repository;
        $this->service = $service;

    }


    public function updateDeviceToken(NotificationRequest $request): JsonResponse
    {

        $response = $this->service->update($request);

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $response,
        ]);
    }
    public function index(Request $request)
    {
        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => [],
        ]);
    }

    public function get()
    {

        $notes = $this->repositoryNote->getAll();

        return response()->json($notes);
    }

    public function detail($id)
    {
        $note = $this->repositoryNote->find($id);
        if ($note) {
            $note->markAsRead($id);
        }

        if (!$note) {
            return response()->json(['message' => 'Not found'], 404);
        }

        return response()->json($note);
    }

    public function destroy($id)
    {

        $deleted = $this->repositoryNote->delete($id);


        if ($deleted) {

            return response()->json([
                'status' => 200,
                'message' => __('notifySuccess'),
                'data' => [],
            ]);
        } else {

            return response()->json(['message' => 'Not found'], 404);
        }
    }

    public function getUserNotifications($user_id)
    {
        $notifications = $this->repositoryNote->getByUserId($user_id);

        if ($notifications->isEmpty()) {
            return response()->json(['message' => 'No notifications found for this user'], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => __('notifySuccess'),
            'data' => $notifications,
        ]);
    }

}
