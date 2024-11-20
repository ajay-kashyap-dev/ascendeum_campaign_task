@extends('layouts.app')

@section('content')
<div class="card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Campaign hourly breakdown of Revenue</h2>
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    </div>

    <!-- Dropdown to select items per page -->
    <form method="GET" action="{{ route('campaign', $campaign->id) }}">
        <div class="d-flex">
            <label for="perPage" class="me-2">Items per page:</label>
            <select name="perPage" id="perPage" class="form-select select-dropdown" onchange="this.form.submit()">
                <option value="10" {{ request('perPage') == '10' ? 'selected' : '' }}>10</option>
                <option value="25" {{ request('perPage') == '25' ? 'selected' : '' }}>25</option>
                <option value="50" {{ request('perPage') == '50' ? 'selected' : '' }}>50</option>
                <option value="100" {{ request('perPage') == '100' ? 'selected' : '' }}>100</option>
            </select>
        </div>
    </form>

    <!-- Data Table (for details or terms) -->
    <div class="table-container">
        <table class="table table-striped table-bordered responsive-table">
            <tr>
                <th>Date</th>
                <th>Hour</th>
                <th>Total Revenue</th>
            </tr>
            @foreach ($details as $detail)
            <tr>
                <td>{{ $detail->event_date }}</td>
                <td>{{ $detail->event_hour }}</td>
                <td>${{ $detail->total_revenue }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $details->appends(['perPage' => request('perPage')])->links() }}
    </div>
</div>
@endsection

