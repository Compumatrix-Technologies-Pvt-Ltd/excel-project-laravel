<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class AnalysisController extends Controller
{

    public function __construct()
    {
        $this->ViewData = [];
        $this->JsonDate = [];
        $this->ModuleView = 'admin.analysis.';
    }

    public function suppliesAnalysis()
    {
        $this->ModuleTitle = __('Supplies Analysis');
        $this->ViewData['moduleAction'] = $this->ModuleTitle;
        return view($this->ModuleView . 'supplies-analysis', $this->ViewData);
    }

    public function suppliesAnalysisGetRecords(Request $request)
    {
        $year = $request->year;
        $type = $request->type;

        $query = Transaction::selectRaw('supplier_id, mill_id, MONTH(trx_date) as month, SUM(weight) as total_weight')
            ->whereYear('trx_date', $year)->where('transaction_by','hq');

        $summary = $query->groupBy('supplier_id', 'mill_id', 'month')->get();

        $grouped = $type === 'supplier'
            ? $summary->groupBy('supplier_id')
            : $summary->groupBy('mill_id');

        $data = [];
        $grandTotals = ['total' => 0];
        for ($m = 1; $m <= 12; $m++) {
            $grandTotals['month_' . $m] = 0;
        }

        foreach ($grouped as $monthsData) {
            $row = [
                'supplier' => $type === 'supplier'
                    ? $monthsData->first()->supplier->supplier_id ?? 'N/A'
                    : $monthsData->first()->mill->name ?? 'N/A',
            ];

            $total = 0;
            for ($m = 1; $m <= 12; $m++) {
                $monthWeight = $monthsData->firstWhere('month', $m)->total_weight ?? 0;
                $row['month_' . $m] = number_format(floatval($monthWeight), 2);
                $total += floatval($monthWeight);

                $grandTotals['month_' . $m] += floatval($monthWeight);
            }

            $row['total'] = number_format($total, 2);
            $grandTotals['total'] += $total;

            $data[] = $row;
        }

        $grandTotals['total'] = number_format($grandTotals['total'], 2);
        for ($m = 1; $m <= 12; $m++) {
            $grandTotals['month_' . $m] = number_format($grandTotals['month_' . $m], 2);
        }

        return response()->json([
            'draw' => intval($request->draw),
            'recordsTotal' => count($data),
            'recordsFiltered' => count($data),
            'data' => $data,
            'grandTotals' => $grandTotals,
        ]);
    }


    public function generateSuppliesAnalysisPDF(Request $request)
    {
        $year = $request->year;
        $type = $request->type;

        $query = Transaction::selectRaw('supplier_id, mill_id, MONTH(trx_date) as month, SUM(weight) as total_weight')
            ->whereYear('trx_date', $year);



        $summary = $query->groupBy('supplier_id', 'mill_id', 'month')->get();

        $grouped = $type === 'supplier'
            ? $summary->groupBy('supplier_id')
            : $summary->groupBy('mill_id');

        $data = [];
        for ($m = 1; $m <= 12; $m++) {
            $grandTotals['month_' . $m] = 0;
        }
        $grandTotals['total'] = 0;

        foreach ($grouped as $entityKey => $monthsData) {
            $row = [
                'supplier' => $type === 'supplier'
                    ? $monthsData->first()->supplier->supplier_id ?? 'N/A'
                    : $monthsData->first()->mill->name ?? 'N/A',
            ];

            $total = 0;
            for ($m = 1; $m <= 12; $m++) {
                $monthWeight = $monthsData->firstWhere('month', $m)->total_weight ?? 0;
                $row['month_' . $m] = number_format($monthWeight, 2);
                $total += $monthWeight;

                $grandTotals['month_' . $m] += $monthWeight;
            }

            $row['total'] = number_format($total, 2);
            $grandTotals['total'] += $total;

            $data[] = $row;
        }

        $grandTotals['total'] = number_format($grandTotals['total'], 2);
        for ($m = 1; $m <= 12; $m++) {
            $grandTotals['month_' . $m] = number_format($grandTotals['month_' . $m], 2);
        }
        $companyName = $loggedInUser->company->name ?? 'N/A';


        $this->ViewData = [
            'data' => $data,
            'year' => $year,
            'type' => $type,
            'grandTotals' => $grandTotals,
            'company_Name' => $companyName,
        ];

        $pdf = Pdf::loadView($this->ModuleView . 'supplies-analysis-pdf', $this->ViewData);

        if ($request->has('preview')) {
            return $pdf->stream('Supplies_analysis_Preview.pdf');
        }
        $fileName = 'Supplies_Analysis_List_' . time() . '.pdf';
        return $pdf->download($fileName);

    }


}

