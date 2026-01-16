<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->authorizeResource(Member::class, 'member');
    }

    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));

        $members = Member::query()
            ->when($q !== '', function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('first_name', 'like', "%{$q}%")
                        ->orWhere('last_name', 'like', "%{$q}%")
                        ->orWhere('phone', 'like', "%{$q}%")
                        ->orWhere('city', 'like', "%{$q}%")
                        ->orWhere('state', 'like', "%{$q}%");
                });
            })
            ->orderBy('last_name')
            ->orderBy('first_name')
            ->paginate(15)
            ->withQueryString();

        return view('members.index', compact('members', 'q'));
    }

    public function create()
    {
        return view('members.create');
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('members/photos', 'public');
        }

        Member::create($data);

        return redirect()->route('members.index')->with('success', 'Member created.');
    }

    public function show(Member $member)
    {
        return view('members.show', compact('member'));
    }

    public function edit(Member $member)
    {
        return view('members.edit', compact('member'));
    }

    public function update(Request $request, Member $member)
    {
        $data = $this->validated($request);

        if ($request->hasFile('photo')) {
            if ($member->photo_path && Storage::disk('public')->exists($member->photo_path)) {
                Storage::disk('public')->delete($member->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('members/photos', 'public');
        }

        $member->update($data);

        return redirect()->route('members.show', $member)->with('success', 'Member updated.');
    }

    public function destroy(Member $member)
    {
        if ($member->photo_path && Storage::disk('public')->exists($member->photo_path)) {
            Storage::disk('public')->delete($member->photo_path);
        }

        $member->delete();

        return redirect()->route('members.index')->with('success', 'Member deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'user_id' => ['nullable', 'integer', 'exists:users,id'],

            'first_name' => ['required', 'string', 'max:100'],
            'last_name'  => ['required', 'string', 'max:100'],

            'address' => ['nullable', 'string', 'max:255'],
            'city'    => ['nullable', 'string', 'max:100'],
            'state'   => ['nullable', 'string', 'size:2'],
            'zip'     => ['nullable', 'string', 'max:10'],

            'phone' => ['nullable', 'string', 'max:25'],

            'date_of_initiation' => ['nullable', 'date'],
            'birthday' => ['nullable', 'date'],

            'photo' => ['nullable', 'image', 'max:2048'], // 2MB
        ]);
    }
}