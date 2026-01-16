@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">Chapter Directory</h2>

        <div class="d-flex gap-2">
            @can('create', \App\Models\Member::class)
                <a class="btn btn-primary" href="{{ route('members.create') }}">Add Member</a>
            @endcan

            @can('members.massUpdate')
                <a class="btn btn-dark" href="{{ route('admin.members.mass_edit') }}">Admin: Mass Edit</a>
            @endcan
        </div>
    </div>

    <form class="row g-2 mb-3" method="GET" action="{{ route('members.index') }}">
        <div class="col-md-6">
            <input class="form-control" name="q" value="{{ $q }}" placeholder="Search name, phone, city, state..." />
        </div>
        <div class="col-auto">
            <button class="btn btn-outline-secondary">Search</button>
        </div>
        <div class="col-auto">
            <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Reset</a>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table align-middle">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>City/State</th>
                    <th>Initiation</th>
                    <th>Birthday</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($members as $member)
                <tr>
                    <td style="width:80px;">
                        @if($member->photoUrl())
                            <img src="{{ $member->photoUrl() }}" class="rounded" style="width:60px;height:60px;object-fit:cover;">
                        @else
                            <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                <span class="text-muted small">N/A</span>
                            </div>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('members.show', $member) }}" class="text-decoration-none fw-semibold">
                            {{ $member->fullName() }}
                        </a>
                    </td>
                    <td>{{ $member->phone }}</td>
                    <td>{{ $member->city }}{{ $member->state ? ', '.$member->state : '' }}</td>
                    <td>{{ optional($member->date_of_initiation)->format('m/d/Y') }}</td>
                    <td>{{ optional($member->birthday)->format('m/d/Y') }}</td>
                    <td class="text-end">
                        <a class="btn btn-sm btn-outline-primary" href="{{ route('members.show', $member) }}">View</a>

                        @can('update', $member)
                            <a class="btn btn-sm btn-warning" href="{{ route('members.edit', $member) }}">Edit</a>
                        @endcan

                        @can('delete', $member)
                            <form class="d-inline" method="POST" action="{{ route('members.destroy', $member) }}"
                                  onsubmit="return confirm('Delete this member?');">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    {{ $members->links() }}
</div>
@endsection