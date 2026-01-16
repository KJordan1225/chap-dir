@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Edit Member</h2>

    <form method="POST" action="{{ route('members.update', $member) }}" enctype="multipart/form-data">
        @method('PUT')
        @include('members._form', ['member' => $member])
        <div class="mt-3">
            <button class="btn btn-warning">Save Changes</button>
            <a class="btn btn-outline-secondary" href="{{ route('members.show', $member) }}">Cancel</a>
        </div>
    </form>
</div>
@endsection