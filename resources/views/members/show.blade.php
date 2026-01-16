@extends('layouts.app')

@section('content')
<div class="container py-4">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="m-0">{{ $member->fullName() }}</h2>
        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Back</a>

            @can('update', $member)
                <a class="btn btn-warning" href="{{ route('members.edit', $member) }}">Edit</a>
            @endcan
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            @if($member->photoUrl())
                <img src="{{ $member->photoUrl() }}" class="rounded w-100" style="object-fit:cover;">
            @else
                <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="height:220px;">
                    <span class="text-muted">No Photo</span>
                </div>
            @endif
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6"><strong>Phone:</strong> {{ $member->phone }}</div>
                        <div class="col-md-6"><strong>Birthday:</strong> {{ optional($member->birthday)->format('m/d/Y') }}</div>

                        <div class="col-md-6"><strong>Initiation Date:</strong> {{ optional($member->date_of_initiation)->format('m/d/Y') }}</div>

                        <div class="col-12">
                            <strong>Address:</strong>
                            <div>{{ $member->address }}</div>
                            <div>{{ $member->city }}{{ $member->state ? ', '.$member->state : '' }} {{ $member->zip }}</div>
                        </div>
                    </div>
                </div>
            </div>

            @can('delete', $member)
                <form class="mt-3" method="POST" action="{{ route('members.destroy', $member) }}"
                      onsubmit="return confirm('Delete this member?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger">Delete Member</button>
                </form>
            @endcan
        </div>
    </div>
</div>
@endsection