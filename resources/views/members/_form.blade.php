@csrf

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">First Name *</label>
        <input class="form-control" name="first_name" value="{{ old('first_name', $member->first_name ?? '') }}" required>
        @error('first_name') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Last Name *</label>
        <input class="form-control" name="last_name" value="{{ old('last_name', $member->last_name ?? '') }}" required>
        @error('last_name') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Address</label>
        <input class="form-control" name="address" value="{{ old('address', $member->address ?? '') }}">
        @error('address') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-5">
        <label class="form-label">City</label>
        <input class="form-control" name="city" value="{{ old('city', $member->city ?? '') }}">
        @error('city') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">State (2-letter)</label>
        <input class="form-control" name="state" value="{{ old('state', $member->state ?? '') }}" maxlength="2">
        @error('state') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-4">
        <label class="form-label">Zip</label>
        <input class="form-control" name="zip" value="{{ old('zip', $member->zip ?? '') }}">
        @error('zip') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label class="form-label">Phone</label>
        <input class="form-control" name="phone" value="{{ old('phone', $member->phone ?? '') }}">
        @error('phone') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Initiation Date</label>
        <input type="date" class="form-control" name="date_of_initiation"
               value="{{ old('date_of_initiation', optional($member->date_of_initiation ?? null)->format('Y-m-d')) }}">
        @error('date_of_initiation') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
        <label class="form-label">Birthday</label>
        <input type="date" class="form-control" name="birthday"
               value="{{ old('birthday', optional($member->birthday ?? null)->format('Y-m-d')) }}">
        @error('birthday') <div class="text-danger small">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
        <label class="form-label">Photo</label>
        <input type="file" class="form-control" name="photo" accept="image/*">
        @error('photo') <div class="text-danger small">{{ $message }}</div> @enderror

        @if(!empty($member) && $member->photoUrl())
            <div class="mt-2">
                <img src="{{ $member->photoUrl() }}" class="rounded" style="width:120px;height:120px;object-fit:cover;">
            </div>
        @endif
    </div>
</div>

@if($errors->any())
    <div class="alert alert-danger mt-3">
        Please fix the errors above.
    </div>
@endif