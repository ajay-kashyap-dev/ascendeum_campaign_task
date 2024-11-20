@extends('layouts.app')

@section('content')
<div class="card">
    <h2 class="mb-4">Campaign List & Revenue</h2>

    <!-- Dropdown to select items per page -->
    <form method="GET" action="{{ route('home') }}" class="d-flex justify-content-between mb-3">
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

    <!-- Campaign Table -->
     <div class="table-container">
        <table class="table table-striped table-bordered responsive-table">
            <thead>
                <tr>
                    <th>Campaign</th>
                    <th>Total Revenue</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($campaigns as $campaign)
                    <tr>
                        <td>{{ $campaign->utm_campaign }}</td>
                        <td>${{ number_format($campaign->total_revenue, 2) }}</td>
                        <td>
                            <a href="{{ route('campaign', $campaign->id) }}" class="btn btn-info btn-sm"><i class="fa fa-clock-o" aria-hidden="true"></i> Hourly revenue</a>
                            <a href="{{ route('publishers', $campaign->id) }}" class="btn btn-info btn-sm"><i class="fa fa-globe" aria-hidden="true"></i> UTM term revenue</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $campaigns->appends(['perPage' => request('perPage')])->links() }}
    </div>
</div>
@endsection
