<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Blotter Reports</title>
    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
        }

        a {
            text-decoration: none;
            color: blue;
        }
    </style>
</head>

<body>
    <h3>Blotter Reports</h3>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Status</th>
                <th>Filed By</th>
                <th>Date Filed</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blotters as $blotter)
                <tr>
                    <td>
                        <a href="{{ route('blotter.pdf', $blotter->blotter_id) }}">
                            Blotter #{{ $blotter->display_id }}
                        </a>
                    </td>
                    <td>{{ $blotter->incident_type }}</td>
                    <td>{{ ucfirst($blotter->status) }}</td>
                    <td>{{ $blotter->resident->full_name ?? 'N/A' }}</td>
                    <td>{{ $blotter->created_at->format('Y-m-d') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>