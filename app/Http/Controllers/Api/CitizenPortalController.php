<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Tender;
use App\Models\Mda;
use App\Models\Applicant;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CitizenPortalController extends Controller
{
    /**
     * Get public dashboard statistics
     */
    public function dashboard(): JsonResponse
    {
        $stats = [
            'total_tenders' => Tender::published()->count(),
            'active_tenders' => Tender::open()->count(),
            'total_contracts' => Contract::signed()->count(),
            'active_contracts' => Contract::active()->count(),
            'completed_contracts' => Contract::completed()->count(),
            'total_spent' => Payment::paid()->sum('amount'),
            'total_mdas' => Mda::active()->count(),
            'registered_vendors' => Applicant::approved()->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $stats
        ]);
    }

    /**
     * Get all published tenders
     */
    public function tenders(Request $request): JsonResponse
    {
        $query = Tender::published()->with(['mda', 'bids']);

        // Filter by MDA
        if ($request->has('mda_id')) {
            $query->where('mda_id', $request->mda_id);
        }

        // Filter by tender type
        if ($request->has('tender_type')) {
            $query->where('tender_type', $request->tender_type);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $tenders = $query->orderBy('created_at', 'desc')
                        ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $tenders
        ]);
    }

    /**
     * Get tender details
     */
    public function tender(Tender $tender): JsonResponse
    {
        if (!$tender->isPublished()) {
            return response()->json([
                'success' => false,
                'message' => 'Tender not found or not published'
            ], 404);
        }

        $tender->load(['mda', 'bids.vendor', 'requisition']);

        return response()->json([
            'success' => true,
            'data' => $tender
        ]);
    }

    /**
     * Get all signed contracts
     */
    public function contracts(Request $request): JsonResponse
    {
        $query = Contract::signed()->with(['mda', 'vendor', 'tender']);

        // Filter by MDA
        if ($request->has('mda_id')) {
            $query->where('mda_id', $request->mda_id);
        }

        // Filter by status
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        // Filter by vendor
        if ($request->has('vendor_id')) {
            $query->where('vendor_id', $request->vendor_id);
        }

        $contracts = $query->orderBy('created_at', 'desc')
                          ->paginate($request->get('per_page', 15));

        return response()->json([
            'success' => true,
            'data' => $contracts
        ]);
    }

    /**
     * Get contract details
     */
    public function contract(Contract $contract): JsonResponse
    {
        if (!$contract->isSigned()) {
            return response()->json([
                'success' => false,
                'message' => 'Contract not found or not signed'
            ], 404);
        }

        $contract->load(['mda', 'vendor', 'tender', 'invoices', 'payments']);

        return response()->json([
            'success' => true,
            'data' => $contract
        ]);
    }

    /**
     * Get MDA spending statistics
     */
    public function mdaSpending(): JsonResponse
    {
        $mdas = Mda::active()->withCount(['contracts', 'tenders'])
                            ->withSum('contracts', 'contract_value')
                            ->get()
                            ->map(function ($mda) {
                                return [
                                    'id' => $mda->id,
                                    'name' => $mda->name,
                                    'code' => $mda->code,
                                    'total_contracts' => $mda->contracts_count,
                                    'total_tenders' => $mda->tenders_count,
                                    'total_spent' => $mda->contracts_sum_contract_value ?? 0,
                                ];
                            })
                            ->sortByDesc('total_spent')
                            ->values();

        return response()->json([
            'success' => true,
            'data' => $mdas
        ]);
    }

    /**
     * Get top contractors
     */
    public function topContractors(): JsonResponse
    {
        $contractors = Applicant::approved()
                               ->withCount(['contracts'])
                               ->withSum('contracts', 'contract_value')
                               ->having('contracts_count', '>', 0)
                               ->get()
                               ->map(function ($vendor) {
                                   return [
                                       'id' => $vendor->id,
                                       'name' => $vendor->name,
                                       'vendor_category' => $vendor->vendor_category,
                                       'total_contracts' => $vendor->contracts_count,
                                       'total_value' => $vendor->contracts_sum_contract_value ?? 0,
                                       'performance_rating' => $vendor->performance_rating,
                                   ];
                               })
                               ->sortByDesc('total_value')
                               ->take(10)
                               ->values();

        return response()->json([
            'success' => true,
            'data' => $contractors
        ]);
    }

    /**
     * Get project status summary
     */
    public function projectStatus(): JsonResponse
    {
        $status = [
            'not_started' => Contract::signed()->where('status', 'active')->count(),
            'ongoing' => Contract::signed()->where('status', 'in_progress')->count(),
            'completed' => Contract::signed()->where('status', 'completed')->count(),
            'total' => Contract::signed()->count(),
        ];

        return response()->json([
            'success' => true,
            'data' => $status
        ]);
    }

    /**
     * Get all MDAs
     */
    public function mdas(): JsonResponse
    {
        $mdas = Mda::active()->select('id', 'name', 'code', 'type', 'description')
                            ->orderBy('name')
                            ->get();

        return response()->json([
            'success' => true,
            'data' => $mdas
        ]);
    }

    /**
     * Search contracts and tenders
     */
    public function search(Request $request): JsonResponse
    {
        $query = $request->get('q');
        $type = $request->get('type', 'all'); // all, tenders, contracts

        $results = [];

        if ($type === 'all' || $type === 'tenders') {
            $tenders = Tender::published()
                            ->where(function ($q) use ($query) {
                                $q->where('name', 'like', "%{$query}%")
                                  ->orWhere('description', 'like', "%{$query}%");
                            })
                            ->with('mda')
                            ->limit(10)
                            ->get();

            $results['tenders'] = $tenders;
        }

        if ($type === 'all' || $type === 'contracts') {
            $contracts = Contract::signed()
                               ->where(function ($q) use ($query) {
                                   $q->where('title', 'like', "%{$query}%")
                                     ->orWhere('description', 'like', "%{$query}%");
                               })
                               ->with(['mda', 'vendor'])
                               ->limit(10)
                               ->get();

            $results['contracts'] = $contracts;
        }

        return response()->json([
            'success' => true,
            'data' => $results
        ]);
    }
}
