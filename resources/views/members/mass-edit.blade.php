@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Admin: Mass Edit Members</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">Please fix the highlighted issues and resubmit.</div>
    @endif

    <form method="POST" action="{{ route('admin.members.mass_update') }}">
        @csrf

        <div class="table-responsive">
            <table class="table table-sm align-middle">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>City</th>
                        <th>State</th>
                        <th>Zip</th>
                        <th>Initiation</th>
                        <th>Birthday</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($members as $i => $m)
                    <tr>
                        <td>
                            <input type="hidden" name="members[{{ $i }}][id]" value="{{ $m->id }}">
                            <div class="d-flex gap-2">
                                <input class="form-control form-control-sm" name="members[{{ $i }}][first_name]"
                                       value="{{ old("members.$i.first_name", $m->first_name) }}" placeholder="First" required>
                                <input class="form-control form-control-sm" name="members[{{ $i }}][last_name]"
                                       value="{{ old("members.$i.last_name", $m->last_name) }}" placeholder="Last" required>
                            </div>
                            @error("members.$i.first_name") <div class="text-danger small">{{ $message }}</div> @enderror
                            @error("members.$i.last_name") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input class="form-control form-control-sm" name="members[{{ $i }}][phone]"
                                   value="{{ old("members.$i.phone", $m->phone) }}">
                            @error("members.$i.phone") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input class="form-control form-control-sm" name="members[{{ $i }}][city]"
                                   value="{{ old("members.$i.city", $m->city) }}">
                            @error("members.$i.city") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input class="form-control form-control-sm" name="members[{{ $i }}][state]"
                                   value="{{ old("members.$i.state", $m->state) }}" maxlength="2">
                            @error("members.$i.state") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input class="form-control form-control-sm" name="members[{{ $i }}][zip]"
                                   value="{{ old("members.$i.zip", $m->zip) }}">
                            @error("members.$i.zip") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input type="date" class="form-control form-control-sm" name="members[{{ $i }}][date_of_initiation]"
                                   value="{{ old("members.$i.date_of_initiation", optional($m->date_of_initiation)->format('Y-m-d')) }}">
                            @error("members.$i.date_of_initiation") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>

                        <td>
                            <input type="date" class="form-control form-control-sm" name="members[{{ $i }}][birthday]"
                                   value="{{ old("members.$i.birthday", optional($m->birthday)->format('Y-m-d')) }}">
                            @error("members.$i.birthday") <div class="text-danger small">{{ $message }}</div> @enderror
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-3 d-flex gap-2">
            <button class="btn btn-dark">Save Bulk Updates</button>
            <a class="btn btn-outline-secondary" href="{{ route('members.index') }}">Back</a>
        </div>
    </form>
</div>
@endsection