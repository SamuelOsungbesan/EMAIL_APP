<!-- resources/views/emails/index.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emails</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .email-container {
            margin: 20px auto;
            max-width: 800px;
        }
        .email-card {
            margin-bottom: 20px;
        }
        .email-title {
            font-weight: bold;
            font-size: 1.25rem;
        }
        .email-content {
            white-space: pre-wrap;
        }
        .table-container {
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container email-container">
        <h1 class="my-4">Fetched Emails</h1>

        @if($emails->isEmpty())
            <div class="alert alert-info" role="alert">
                No emails found.
            </div>
            <div class="card email-card">
                <div class="card-body">
                    <div class="table-container">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>DATE KEY</th>
                                    <th>USSD CODE</th>
                                    <th>ADJ AMT</th>
                                    <th>PARTNER NAME</th>
                                    <th>OPENING BALANCE</th>
                                    <th>USED</th>
                                    <th>CLOSING BALANCE</th>
                                    <th>EXPIRY DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="8" class="text-center">No data available</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @else
            @foreach ($emails as $email)
                <div class="card email-card">
                    <div class="card-header email-title">
                        {{ $email->title }}
                    </div>
                    <div class="card-body">
                        <div class="table-container">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>DATE KEY</th>
                                        <th>USSD CODE</th>
                                        <th>ADJ AMT</th>
                                        <th>PARTNER NAME</th>
                                        <th>OPENING BALANCE</th>
                                        <th>USED</th>
                                        <th>CLOSING BALANCE</th>
                                        <th>EXPIRY DATE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>{{ $email->date_key }}</td>
                                        <td>{{ $email->ussd_code }}</td>
                                        <td>{{ $email->adj_amt }}</td>
                                        <td>{{ $email->partner_name }}</td>
                                        <td>{{ $email->opening_balance }}</td>
                                        <td>{{ $email->used }}</td>
                                        <td>{{ $email->closing_balance }}</td>
                                        <td>{{ $email->expiry_date }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</body>
</html>
