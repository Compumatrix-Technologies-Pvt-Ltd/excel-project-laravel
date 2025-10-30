<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mill;
use App\Models\Suppliers;
use App\Models\Transaction;
use App\Models\User;
use Faker\Provider\ar_EG\Company;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;

class SuppliesController extends Controller
{

    public function __construct()
    {
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.supplies.';
    }

    public function suppliesDetails()
    {
        $this->ModuleTitle = __('Supplies Details');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Suppliers'] = Suppliers::with('user')->where('user_id', auth()->user()->id)->where('supplier_mode','hq')->get();
        $this->ViewData['allMills'] = Mill::all();
        return view($this->ModuleView . 'supplies-details', $this->ViewData);
    }

    public function getSuppliesRecords(Request $request)
    {
        try {
            $start = $request->start ?? 0;
            $length = $request->length ?? 10;
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            $supplierId = $request->supplier_id;

            $allMills = Mill::all(); 
            $loggedInUser = auth()->user();

            $baseQuery = Transaction::with(['supplier', 'vehicle']);

            if ($loggedInUser->hasRole('hq')) {
                $baseQuery->where('user_id', $loggedInUser->id);
            }

            if ($supplierId) {
                $baseQuery->where('supplier_id', $supplierId);
            }

            if ($startDate && $endDate) {
                $baseQuery->whereBetween('trx_date', [$startDate, $endDate]);
            }

            if (!empty($request->search['value'])) {
                $search = $request->search['value'];
                $baseQuery->where(function ($q) use ($search) {
                    $q->where('ticket_no', 'like', "%{$search}%")
                        ->orWhere('trx_date', 'like', "%{$search}%")
                        ->orWhereHas('supplier', function ($q2) use ($search) {
                            $q2->where('supplier_name', 'like', "%{$search}%");
                        });
                });
            }

            $totalRecords = $baseQuery->count();

            $records = $baseQuery
                ->offset($start)
                ->limit($length)
                ->orderBy('trx_date', 'desc')
                ->get();

            $data = [];
            $grandTotals = [];

            foreach ($allMills as $mill) {
                $grandTotals['mill_' . $mill->id] = 0;
            }
            $grandTotals['total_weight'] = 0;

            foreach ($records as $record) {
                $row = [
                    'supplier_id' => $record->supplier->supplier_id ?? 'N/A',
                    'vehicle' => $record->vehicle->name ?? 'N/A',
                    'date' => $record->trx_date,
                    'ticket_no' => $record->ticket_no,
                ];

                $totalWeight = 0;

                foreach ($allMills as $mill) {
                    $weight = $record->mill_id == $mill->id ? number_format($record->weight, 2) : '';
                    $row['mill_' . $mill->id] = $weight;
                    $grandTotals['mill_' . $mill->id] += ($weight !== '') ? floatval($record->weight) : 0;
                    $totalWeight += ($weight !== '') ? floatval($record->weight) : 0;
                }

                $row['total_weight'] = number_format($totalWeight, 2);
                $grandTotals['total_weight'] += $totalWeight;

                $data[] = $row;
            }

            return response()->json([
                'draw' => intval($request->draw),
                'recordsTotal' => $totalRecords,
                'recordsFiltered' => $totalRecords,
                'data' => $data,
                'allMills' => $allMills,
                'grandTotals' => array_map(function ($val) {
                    return number_format($val, 2);
                }, $grandTotals)
            ]);

        } catch (Exception $e) {
            return response()->json([
                'error' => 'Error fetching data',
                'message' => $e->getMessage()
            ], 500);
        }
    }



    public function generateSuppliesPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $supplierId = $request->supplier_id;

        $loggedInUser = auth()->user();

        $query = Transaction::with(['supplier', 'vehicle']);

        if ($loggedInUser->hasRole('hq')) {
            $query->where('user_id', $loggedInUser->id);
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('trx_date', [$startDate, $endDate]);
        }

        $transactions = $query->get();
        $allMills = Mill::all();

        $supplierName = 'All Suppliers';
        if ($supplierId) {
            $supplier = Suppliers::find($supplierId);
            $supplierName = $supplier ? $supplier->supplier_id : 'N/A';
        }

        $user = auth()->user();
        $companyName = $user->company->name ?? 'N/A';

        $viewData = [
            'transactions' => $transactions,
            'allMills' => $allMills,
            'startDate' => \Carbon\Carbon::parse($startDate)->format('d-M-Y'),
            'endDate' => \Carbon\Carbon::parse($endDate)->format('d-M-Y'),
            'supplierName' => $supplierName,
            'company_Name' => $companyName,
        ];

        $pdf = Pdf::loadView($this->ModuleView . 'supplies-pdf', $viewData);

        if ($request->has('preview')) {
            return $pdf->stream('Supplies_Preview.pdf');
        }

        $fileName = 'Supplies_List_' . time() . '.pdf';
        return $pdf->download($fileName);
    }

    public function suppliesSummary()
    {
        $this->ModuleTitle = __('Supplies Summary');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        $this->ViewData['Suppliers'] = Suppliers::with('user')->where('user_id', auth()->user()->id)->get();
        $this->ViewData['allMills'] = Mill::all();
        return view($this->ModuleView . 'supplies-summary', $this->ViewData);
    }


    public function suppliesSummaryGetRecords(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $supplierId = $request->supplier_id;

        $allMills = Mill::all();
        $loggedInUser = auth()->user();

        $query = Transaction::with(['supplier', 'vehicle']);
        $query->whereHas('supplier', function ($q2) {
            $q2->where('supplier_mode', 'hq');
        });
        if ($loggedInUser->hasRole('hq')) {
            $query->where('user_id', $loggedInUser->id);
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('trx_date', [$startDate, $endDate]);
        }

        $transactions = $query->get();

        $grouped = $transactions->groupBy('supplier_id');

        $data = [];
        $grandTotals = [];
        foreach ($allMills as $mill) {
            $grandTotals['mill_' . $mill->id] = 0;
        }
        $grandTotals['total_weight'] = 0;

        foreach ($grouped as $supplierId => $transactionsOfSupplier) {
            $row = [
                'supplier_id' => $transactionsOfSupplier->first()->supplier->supplier_id ?? 'N/A',
                'total_weight' => 0
            ];

            $supplierTotalWeight = 0;

            foreach ($allMills as $mill) {
                // Sum weights of this supplier & mill
                $millTotal = $transactionsOfSupplier
                    ->where('mill_id', $mill->id)
                    ->sum('weight');

                $row['mill_' . $mill->id] = number_format($millTotal, 2);
                $grandTotals['mill_' . $mill->id] += $millTotal;
                $supplierTotalWeight += $millTotal;
            }

            $row['total_weight'] = number_format($supplierTotalWeight, 2);
            $grandTotals['total_weight'] += $supplierTotalWeight;

            $data[] = $row;
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data,
            'grandTotals' => array_map(function ($val) {
                return number_format($val, 2);
            }, $grandTotals)
        ]);
    }



    public function generateSuppliesSummaryPdf(Request $request)
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;
        $supplierId = $request->supplier_id;

        $loggedInUser = auth()->user();
        $transactionsSummary =[];
        $query = Transaction::with(['supplier']);

        if ($loggedInUser->hasRole('hq')) {
            $query->where('user_id', $loggedInUser->id);
        }

        if ($supplierId) {
            $query->where('supplier_id', $supplierId);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('trx_date', [$startDate, $endDate]);
        }

        $transactions = $query->get();
        $allMills = Mill::all();

        // Group transactions by supplier_id
        $grouped = $transactions->groupBy('supplier_id');

        foreach ($grouped as $supplierId => $transactionsOfSupplier) {
            $row = [
                'supplier_id' => $transactionsOfSupplier->first()->supplier->supplier_id ?? 'N/A',
                'total_weight' => 0
            ];

            $supplierTotal = 0;

            foreach ($allMills as $mill) {
                $millTotal = floatval($transactionsOfSupplier
                    ->where('mill_id', $mill->id)
                    ->sum('weight'));

                $row['mill_' . $mill->id] = $millTotal; 
                $supplierTotal += $millTotal;
            }

            $row['total_weight'] = $supplierTotal; 
            $transactionsSummary[] = $row;
        }

        $supplierName = 'All Suppliers';
        if ($supplierId) {
            $supplier = Suppliers::find($supplierId);
            $supplierName = $supplier ? $supplier->supplier_id : 'N/A';
        }

        $companyName = $loggedInUser->company->name ?? 'N/A';

        $viewData = [
            'transactions' => $transactionsSummary,
            'allMills' => $allMills,
            'startDate' => \Carbon\Carbon::parse($startDate)->format('d-M-Y'),
            'endDate' => \Carbon\Carbon::parse($endDate)->format('d-M-Y'),
            'supplierName' => $supplierName,
            'company_Name' => $companyName,
        ];

        $pdf = Pdf::loadView($this->ModuleView . 'supplies-summary-pdf', $viewData)->setPaper('A4', 'landscape');

        if ($request->has('preview')) {
            return $pdf->stream('Supplies_Summary_Preview.pdf');
        }

        $fileName = 'Supplies_Summary_List_' . time() . '.pdf';
        return $pdf->download($fileName);
    }


}
