@extends('layouts.app')

@section('title', 'Apply Leave')

@section('content')
<h1>Apply for Leave</h1>
<form action="{{ route('leaves.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="employeecode" class="form-label">Employee Code:</label>
        <input type="text" name="employeecode" id="employeecode" class="form-control" required>
        @error('employeecode')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="fromdate" class="form-label">From Date:</label>
        <input type="date" name="fromdate" id="fromdate" class="form-control" required>
        @error('fromdate')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="todate" class="form-label">To Date:</label>
        <input type="date" name="todate" id="todate" class="form-control" required>
        @error('todate')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="leavetype" class="form-label">Leave Type:</label>
        <select name="leavetype" id="leavetype" class="form-control" required>
            @foreach($leaveTypes as $leaveType)
                <option value="{{ $leaveType->id }}">{{ $leaveType->leaveType }}</option>
            @endforeach
        </select>
        @error('leavetype')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <div class="mb-3">
        <label for="comment" class="form-label">Comments:</label>
        <textarea name="comment" id="comment" rows="3" class="form-control" maxlength="300"></textarea>
        @error('comment')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

@endsection
