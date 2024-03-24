<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Metric;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class MetricController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $metrics = Metric::select('id', 'name', 'code', 'platform', 'description')->filter()->paginate(25);

        return view('metrics.index', compact('metrics'));
    }

    public function new()
    {
        return view('metrics.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'platform' => 'required',
        ]);

        Metric::create($request->all());

        return redirect()->route('metrics')->with('success', 'Metric successfully created!');
    }

    public function edit(Metric $metric)
    {
        return view('metrics.edit', compact('metric'));
    }

    public function update(Request $request, Metric $metric)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'platform' => 'required'
        ]);

        $metric->update($request->all());

        return redirect()->route('metrics')->with('warning', 'Metric successfully updated!');
    }

    public function destroy(Metric $metric)
    {
        try {
            $metric->delete();
            return redirect()->back()->with('danger', 'Metric successfully deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Metric not found!');
        }
    }

    public function export()
    {
        $data = Metric::select('id', 'name', 'code', 'platform', 'description', 'created_at')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['ID', 'Name', 'Code', 'Platform', 'Description', 'Created At'], null, 'A1');

        $rows = 2;

        foreach ($data as $d) {
            $sheet->fromArray([
                $d->id,
                $d->name,
                $d->code,
                $d->platform,
                $d->description,
                $d->created_at ?? Carbon::now(),
            ], null, 'A' . $rows);

            $rows++;
        }

        $fileName = "Metric.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);

        return response()->file($fileName, [
            'Content-Type' => 'application/xls',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
