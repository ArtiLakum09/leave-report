@extends('layouts.app')

@section('title', 'Leave Report')

@section('content')
<h1>Leave Report</h1>

<h2>User-Wise Leave Data</h2>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Employee Code</th>
            <th>Employee Name</th>
            <th>Total Leaves</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reportData as $data)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $data->employeecode }}</td>
            <td>{{ $data->employee_name }}</td>
            <td>{{ $data->total_leaves }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<h2>Graphical Leave Report</h2>
<canvas id="leaveReportGraph"></canvas>
<script>
    const ctx = document.getElementById('leaveReportGraph').getContext('2d');
    const leaveChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($graphData->pluck('employee')), // Employee names
            datasets: [{
                label: 'Total Leaves',
                data: @json($graphData->pluck('total_leaves')), // Total leave counts
                backgroundColor: '#36a2eb',
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'User-Wise Leave Report'
                }
            }
        }
    });
</script>

@endsection
