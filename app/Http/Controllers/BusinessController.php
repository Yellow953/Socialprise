<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\Role;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class BusinessController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $businesses = Business::select('id', 'name', 'page_id', 'instagram_business_account', 'role_id')->filter()->paginate(25);

        return view('businesses.index', compact('businesses'));
    }

    public function new()
    {
        $roles = Role::select('id', 'name')->get();
        return view('businesses.new', compact('roles'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'page_id' => ['required', 'string', 'max:255'],
        ]);

        Business::create($request->all());

        return redirect()->route('businesses')->with('success', 'Business successfully created!');
    }

    public function edit(Business $business)
    {
        $roles = Role::select('id', 'name')->get();
        $data = compact('business', 'roles');

        return view('businesses.edit', $data);
    }

    public function update(Request $request, Business $business)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'page_id' => ['required', 'string', 'max:255'],
        ]);

        $business->update($request->all());

        return redirect()->route('businesses')->with('warning', 'Business successfully updated!');
    }

    public function destroy(Business $business)
    {
        try {
            $business->delete();
            return redirect()->back()->with('danger', 'Business successfully deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'Business found in other Models!');
        }
    }

    public function export()
    {
        $data = Business::select('id', 'name', 'page_id', 'instagram_business_account', 'access_token', 'created_at')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['ID', 'Name', 'Page ID', 'Access Token', 'Created At'], null, 'A1');

        $rows = 2;

        foreach ($data as $d) {
            $sheet->fromArray([
                $d->id,
                $d->name,
                $d->page_id,
                $d->instagram_business_account,
                $d->access_token,
                $d->created_at ?? Carbon::now(),
            ], null, 'A' . $rows);

            $rows++;
        }

        $fileName = "Businesses.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);

        return response()->file($fileName, [
            'Content-Type' => 'application/xls',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
