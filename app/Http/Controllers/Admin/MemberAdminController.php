<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class MemberAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function edit()
    {
        Gate::authorize('members.massUpdate');

        $members = Member::query()
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->get();

        return view('admin.members.mass-edit', compact('members'));
    }

    public function update(Request $request)
    {
        Gate::authorize('members.massUpdate');

        $data = $request->validate([
            'members' => ['required', 'array'],
            'members.*.id' => ['required', 'integer', 'exists:members,id'],

            'members.*.first_name' => ['required', 'string', 'max:100'],
            'members.*.last_name'  => ['required', 'string', 'max:100'],

            'members.*.address' => ['nullable', 'string', 'max:255'],
            'members.*.city'    => ['nullable', 'string', 'max:100'],
            'members.*.state'   => ['nullable', 'string', 'size:2'],
            'members.*.zip'     => ['nullable', 'string', 'max:10'],

            'members.*.phone' => ['nullable', 'string', 'max:25'],
            'members.*.date_of_initiation' => ['nullable', 'date'],
            'members.*.birthday' => ['nullable', 'date'],
        ]);

        foreach ($data['members'] as $row) {
            Member::whereKey($row['id'])->update([
                'first_name' => $row['first_name'],
                'last_name'  => $row['last_name'],
                'address'    => $row['address'] ?? null,
                'city'       => $row['city'] ?? null,
                'state'      => $row['state'] ?? null,
                'zip'        => $row['zip'] ?? null,
                'phone'      => $row['phone'] ?? null,
                'date_of_initiation' => $row['date_of_initiation'] ?? null,
                'birthday' => $row['birthday'] ?? null,
            ]);
        }

        return back()->with('success', 'Bulk update saved.');
    }
}