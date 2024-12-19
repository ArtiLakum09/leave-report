@extends('layouts.app')

@section('content')
<div class="container">
    <h2>User-wise Leave Report</h2>

    <!-- Table showing employee-wise total leaves taken -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Total Leave Taken (Days)</th>
                <th>Leave Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reportData as $data)
                <tr>
                    <td>{{ $data->employeecode }}</td>
                    <td>
                        <!-- Display employee name (optional) -->
                        @php
                            $employee = $employees->where('employee_code', $data->employeecode)->first();
                        @endphp
                        {{ $employee->employee_name ?? 'Unknown' }}
                    </td>
                    <td>{{ $data->total_leave }}</td>
                    <td>
                        @php
                            $balance = $leaveBalances->where('leavetype', $data->employeecode)->first();
                        @endphp
                        {{ $balance->leavebalance ?? 'N/A' }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Display leave balance vs total leave graph (ChartJS example) -->
    <canvas id="leaveReportChart" width="400" height="200"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('leaveReportChart').getContext('2d');
    const leaveReportChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
                @foreach($reportData as $data)
                    '{{ $data->employeecode }}',
                @endforeach
            ],
            datasets: [{
                label: 'Total Leave Taken',
                data: [
                    @foreach($reportData as $data)
                        {{ $data->total_leave }},
                    @endforeach
                ],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }, {
                label: 'Leave Balance',
                data: [
                    @foreach($reportData as $data)
                        @php
                            $balance = $leaveBalances->where('leavetype', $data->employeecode)->first();
                        @endphp
                        {{ $balance->leavebalance ?? 0 }},
                    @endforeach
                ],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>

@endsection
