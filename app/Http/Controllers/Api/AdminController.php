<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Dashboard statistics.
     */
    public function dashboard(): JsonResponse
    {
        $stats = [
            'total_users'   => User::where('role', 'user')->count(),
            'total_tukangs' => User::where('role', 'tukang')->count(),
            'orders' => [
                'pending'   => Order::where('status', 'pending')->count(),
                'accepted'  => Order::where('status', 'accepted')->count(),
                'completed' => Order::where('status', 'completed')->count(),
                'cancelled' => Order::where('status', 'cancelled')->count(),
                'total'     => Order::count(),
            ],
        ];

        return response()->json([
            'success' => true,
            'message' => 'Dashboard statistics',
            'data'    => $stats,
        ]);
    }

    /**
     * List all users (paginated, filterable by role).
     */
    public function users(Request $request): JsonResponse
    {
        $query = User::with('tukangProfile')->latest();

        if ($request->has('role') && in_array($request->query('role'), ['admin', 'user', 'tukang'])) {
            $query->where('role', $request->query('role'));
        }

        $users = $query->paginate($request->query('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'List of users',
            'data'    => $users,
        ]);
    }

    /**
     * List all orders (paginated, filterable by status).
     */
    public function orders(Request $request): JsonResponse
    {
        $query = Order::with([
            'user:id,name,phone_number',
            'tukang:id,name,phone_number',
            'review',
        ])->latest();

        if ($request->has('status') && in_array($request->query('status'), ['pending', 'accepted', 'completed', 'cancelled'])) {
            $query->where('status', $request->query('status'));
        }

        $orders = $query->paginate($request->query('per_page', 15));

        return response()->json([
            'success' => true,
            'message' => 'List of orders',
            'data'    => $orders,
        ]);
    }
}
