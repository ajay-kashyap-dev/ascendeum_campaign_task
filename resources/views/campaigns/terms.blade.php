@extends('layouts.app')

@section('content')
<div class="card">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Revenue breakdown by UTM term</h2>
        <a href="{{ route('home') }}" class="btn btn-secondary"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
    </div>

    <!-- Dropdown to select items per page -->
    <form method="GET" action="{{ route('publishers', $campaign->id) }}">
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

    <!-- Terms Table (for terms listing) -->
    <div class="table-container">
        <table class="table table-striped table-bordered responsive-table">
            <tr>
                <th>Term</th>
                <th>Total Revenue</th>
            </tr>
            @foreach ($terms as $term)
            <tr>
                <td>{{ $term->utm_term }}</td>
                <td>${{ $term->total_revenue }}</td>
            </tr>
            @endforeach
        </table>
    </div>

    <!-- Pagination -->
    <div class="pagination">
        {{ $terms->appends(['perPage' => request('perPage')])->links() }}
    </div>
</div>
@endsection
