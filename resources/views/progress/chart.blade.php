<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Progress</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<div class="container mt-5">
    <nav class="navbar navbar-expand-lg navbar-light  fixed-top">
        <div class="container">
            <div class="container mt-4">
                <a href="javascript:history.back()" class="btn btn-secondary mb-4">Back</a>
            </div>
            </li>

            </ul>
    </nav>

<body>
    <div class="container mt-4">


        <h3 class="text-center mb-4">Progress Bar Graph</h3>

        <!-- Canvas element to render the chart -->
        <canvas id="progressChart" width="600" height="400"></canvas> <!-- Fixed width and height -->

        
        <script>
            // Data from the server passed into JavaScript
            const progressData = @json($progress);

            console.log(progressData);

            // Prepare data for Chart.js
            const labels = progressData.map(entry => {
                const date = new Date(entry.start_date);
                return date.toLocaleDateString(); // Format the date to a readable string
            });
            const startingWeights = progressData.map(entry => entry.starting_weight); // Y-axis data (Starting Weight)
            const closingWeights = progressData.map(entry => entry.closing_weight); // Y-axis data (Closing Weight)

            // Create a bar chart with Chart.js
            const ctx = document.getElementById('progressChart').getContext('2d');
            const progressChart = new Chart(ctx, {
                type: 'bar', // Change type to 'bar' for bar chart
                data: {
                    labels: labels, // X-axis labels
                    datasets: [
                        {
                            label: 'Starting Weight (kg)',
                            data: startingWeights,
                            backgroundColor: 'rgb(75, 192, 192)', // Bar color for starting weight
                            borderColor: 'rgb(75, 192, 192)', // Border color for starting weight
                            borderWidth: 1, // Border width
                        },
                        {
                            label: 'Closing Weight (kg)',
                            data: closingWeights,
                            backgroundColor: 'rgb(255, 99, 132)', // Bar color for closing weight
                            borderColor: 'rgb(255, 99, 132)', // Border color for closing weight
                            borderWidth: 1, // Border width
                        }
                    ]
                },
                options: {
                    responsive: false, // Disable responsiveness to prevent resizing
                    scales: {
                        y: {
                            beginAtZero: true, // Ensure the Y-axis starts at zero
                            ticks: {
                                stepSize: 5, // Smaller step size for Y-axis ticks (smaller increments)
                            },
                        },
                        x: {
                            ticks: {
                                autoSkip: true, // Skip some labels to avoid overlap
                                maxRotation: 45, // Rotate labels to avoid text overlap
                                minRotation: 30,
                            },
                            // Adjust spacing and bar width
                            barPercentage: 0.2, // Decrease bar width (shorter bars)
                            categoryPercentage: 0.4, // Decrease space between bars
                            maxBarThickness: 10, // Limit maximum bar thickness
                        }
                    },
                    layout: {
                        padding: {
                            left: 10,
                            right: 10,
                            top: 10,
                            bottom: 10
                        }
                    },
                    plugins: {
                        legend: {
                            position: 'top',
                        }
                    }
                }
            });
        </script>
    </div>
</div>

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

<style>
    body {
        padding-top: 120px;

    }


    .container {
        margin-top: 20px;
    }

    .navbar {
        font-size: 1.3rem;
        padding: 1.2rem 0;
        background-color: purple;
    }

    .navbar-brand {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .navbar-nav .nav-link {
        padding: 0.8rem 1rem;

    }


</style>
