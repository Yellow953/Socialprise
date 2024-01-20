<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::select('id', 'name', 'email', 'created_at')->filter()->paginate(25);

        return view('users.index', compact('users'));
    }

    public function new()
    {
        return view('users.new');
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect('/users')->with('success', 'User successfully created!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        if (!$user) {
            return redirect('/users')->with('danger', 'User not found!');
        }

        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $user = User::findOrFail($id);

        if (!$user) {
            return redirect('/users')->with('danger', 'User not found!');
        }

        $user->update(
            $request->all()
        );

        return redirect('/users')->with('warning', 'User successfully updated!');
    }

    public function destroy($id)
    {
        try {
            User::findOrFail($id)->delete();

            return redirect()->back()->with('danger', 'User successfully deleted!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', 'User found in other Models!');
        }
    }

    public function password()
    {
        return view('users.change_password');
    }

    public function change_password(Request $request, $id)
    {
        $request->validate([
            'new_password' => ['required', 'string', 'min:6'],
            'confirm_password' => ['required', 'string', 'min:6'],

        ]);

        $user = User::findOrFail($id);

        if ($request->new_password == $request->confirm_password) {
            $user->password = Hash::make($request->new_password);
            $user->save();
        }

        return redirect()->back()->with('success', 'Password Updated Successfully');
    }

    public function export()
    {
        $data = User::select('id', 'name', 'email', 'created_at')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->fromArray(['ID', 'Name', 'Email', 'Created At'], null, 'A1');

        $rows = 2;

        foreach ($data as $d) {
            $sheet->fromArray([
                $d->id,
                $d->name,
                $d->email,
                $d->created_at ?? Carbon::now(),
            ], null, 'A' . $rows);

            $rows++;
        }

        $fileName = "Users.xls";
        $writer = new Xls($spreadsheet);
        $writer->save($fileName);

        return response()->file($fileName, [
            'Content-Type' => 'application/xls',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
}
