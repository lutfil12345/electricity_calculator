<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Electricity Calculator</title>
    <link  rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4 text-center">Electricity Calculator</h2>
    <form method="post" class="border p-4 bg-white rounded">
        <div class="form-group">
            <label for="voltage">Voltage</label>
            <input type="number" step="any" class="form-control" id="voltage" name="voltage" required>
            <label for="V">Voltage (V)</label>
        </div>
        <div class="form-group">
            <label for="Ampere">Current</label>
            <input type="number" step="any" class="form-control" id="ampere" name="ampere" required>
            <label for="A">Ampere (A)</label>
        </div>
        <div class="form-group">
            <label for="">Current Rate</label>
            <input type="number" step="any" class="form-control" id="rate" name="rate" required>
            <label for="sen">sen/kWh</label>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Calculate</button>
    </form>
   
   <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST'):

        $voltage = $_POST['voltage'];
        $ampere = $_POST['ampere'];
        $rate = $_POST['rate'];

        $power = ($voltage * $ampere) / 1000;
        $rate_rm = $rate / 100;
    ?>
<div class="mt-5">
      <h4>Results</h4>
      <p class="text-primary"><strong>Power:</strong> <?= number_format($power, 5) ?> kW</p>
      <p class="text-primary"><strong>Rate:</strong> <?= number_format($rate_rm, 3) ?> RM</p>
</div>
<table class="table table-bordered mt-4">
        <thead class="thead-dark">
          <tr>
            <th># Hour</th>
            <th>Energy (kWh)</th>
            <th>Total (RM)</th>
          </tr>
        </thead>
        <tbody>
          <?php
            for ($hour = 1; $hour <= 24; $hour++) {
              $energy = $power * $hour;
              $total = $energy * $rate_rm;
              echo "<tr>
                      <td>$hour</td>
                      <td>" . number_format($energy, 5) . "</td>
                      <td>" . number_format($total, 2) . "</td>
                    </tr>";
            }
          ?>
        </tbody>
      </table>
<?php endif; ?>   
</body>
</html>