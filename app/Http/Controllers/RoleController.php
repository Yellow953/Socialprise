<?php

namespace App\Http\Controllers;

use App\Models\Metric;
use Illuminate\Http\Request;
use App\Models\Role;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $roles = Role::select('id', 'name', 'description')->filter()->paginate(25);

        return view('roles.index', compact('roles'));
    }

    public function new()
    {
        $metrics = Metric::select('id', 'name')->get();
        return view('roles.new', compact('metrics'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles',
            'metrics' => 'array',
            'metrics.*' => 'exists:metrics,id',
        ]);

        $role = Role::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        if ($request->has('metrics')) {
            $role->metrics()->attach($request->input('metrics'));
        }

        return redirect()->route('roles')->with('success', 'Role successfully created!');
    }

    public function edit(Role $role)
    {
        $metrics = Metric::select('id', 'name')->get();
        $data = compact('role', 'metrics');

        return view('roles.edit', $data);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $role->update($request->all());

        return redirect()->route('roles')->with('warning', 'Role successfully updated!');
    }

    public function destroy(Role $role)
    {
        try {
            $role->delete();
            return redirect()->back()->with('danger', 'Role successfully deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Role not found!');
        }
    }

    public function export()
    {
        $data = Role::select('id', 'name', 'description', 'created_at')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['ID', 'Name', 'Description', 'Created At'], null, 'A1');

        $rows = 2;

        foreach ($data as $d) {
            $sheet->fromArray([
                $d->id,
                $d->name,
                $d->description,
                $d->created_at ?? Carbon::now(),
            ], null, 'A' . $rows);

            $rows++;
        }

        $fileName = "Roles.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);

        return response()->file($fileName, [
            'Content-Type' => 'application/xls',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
