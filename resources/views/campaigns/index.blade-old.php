<form method="GET" action="{{ route('home') }}">
    <!-- Dropdown for selecting perPage -->
    <select name="perPage" onchange="this.form.submit()">
        <option value="1" {{ request('perPage') == '1' ? 'selected' : '' }}>1</option>
        <option value="10" {{ request('perPage') == '10' ? 'selected' : '' }}>10</option>
        <option value="25" {{ request('perPage') == '25' ? 'selected' : '' }}>25</option>
        <option value="50" {{ request('perPage') == '50' ? 'selected' : '' }}>50</option>
        <option value="100" {{ request('perPage') == '100' ? 'selected' : '' }}>100</option>
    </select>
</form>

<!-- Campaigns Table -->
<table>
    <tr>
        <th>Campaign</th>
        <th>Total Revenue</th>
    </tr>
    @foreach ($campaigns as $campaign)
    <tr>
        <td><a href="/campaigns/{{ $campaign->id }}">{{ $campaign->utm_campaign }}</a></td>
        <td>{{ $campaign->total_revenue }}</td>
    </tr>
    @endforeach
</table>

<!-- Pagination Links -->
{{ $campaigns->appends(['perPage' => request('perPage')])->links() }}