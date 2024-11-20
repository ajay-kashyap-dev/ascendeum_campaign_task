<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Campaigns Dashboard</title>

    <!-- Add your custom stylesheets or include a CSS framework like Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet"> <!-- For icons -->

    <style>
        body {
            background-color: #f4f6f9;
            font-family: 'Arial', sans-serif;
        }

        .container {
            margin-top: 30px;
        }

        .table {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 12px;
            text-align: center;
        }

        .pagination {
            justify-content: center;
        }

        .select-dropdown {
            width: 150px;
            margin-bottom: 15px;
        }

        .btn {
            font-size: 14px;
            padding: 6px 12px;
        }

        .header {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
        }

        .header h1 {
            font-size: 36px;
        }

        .card {
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 20px;
            background-color: white;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }
    </style>
    <style>
    /* Pagination Styles */
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        margin-top: 20px;
    }

    .pagination a, .pagination span {
        padding: 8px 16px !important;
        margin: 0 4px;
        /* background-color: #007bff !important; */
        color: #000000;
        border-radius: 5px;
        text-decoration: none;
        font-weight: 600;
        transition: background-color 0.3s ease;
        display: inline-block; /* Ensure pagination links appear inline */
    }
    .pagination span{
        margin:0px !important;
    }
    .pagination a svg,
    .pagination span svg {
        fill: #000000; /* Bold color */
        stroke: #000000; /* Add stroke to make it appear bold */
        stroke-width: 1.5; /* Adjust stroke width */
        width: 18px; /* Slightly larger for emphasis */
        height: 18px;
        vertical-align: middle;
        transition: all 0.3s ease;
    }

    .pagination a:hover svg {
        fill: #0056b3; /* Darker shade on hover */
        stroke: #0056b3;
    }

    .pagination .disabled svg {
        fill: #b3b3b3; /* Gray for disabled state */
        stroke: #b3b3b3;
        cursor: not-allowed;
    }

    .pagination .sm\:hidden { /* Hides the "Next" button */
        display: none;
    }


    .pagination a:hover {
        background-color: #0056b3 !important;
    }

    .pagination .active span {
        background-color: #0056b3;
        cursor: default;
    }

    .pagination .disabled span {
        background-color: #e0e0e0;
        color: #b3b3b3;
        cursor: not-allowed;
    }

    /* .pagination .page-link {
        padding: 10px;
        font-size: 16px;
    } */

    /* .pagination .page-item {
        margin: 0 5px;
    }

    .pagination .page-item:first-child .page-link,
    .pagination .page-item:last-child .page-link {
        font-size: 18px;
    } */

    /* Button Styling */
    /* .btn {
        display: inline-block;
        padding: 8px 15px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        text-align: center;
        text-decoration: none;
        cursor: pointer;
        margin: 5px;
        transition: background-color 0.3s ease;
    }

    .btn:hover {
        background-color: #0056b3;
    }

    .btn-sm {
        font-size: 12px;
        padding: 5px 10px;
    }

    /* Align Table Buttons */
    .table td .btn {
        margin-right: 10px;
    } */
</style>

</head>
<body>
    <div class="container">
        <!-- Header Section -->
        <div class="header">
            <h1>Campaigns Dashboard</h1>
        </div>

        <!-- Main Content Section -->
        @yield('content')
    </div>

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
