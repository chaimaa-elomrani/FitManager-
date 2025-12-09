<?php
require 'courses.php';
require 'equipmentController.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Course & Equipment Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body class="bg-white">
    <!-- Header -->
    <header class="bg-black text-white py-6 px-8 border-b-4 border-red-600">
        <h1 class="text-4xl font-bold">Management System</h1>
        <p class="text-red-500 mt-2 text-lg">Course & Equipment Dashboard</p>
    </header>

    <!-- Navigation -->
    <nav class="bg-black px-8 py-4 flex gap-8">
        <a href="index.php" class="text-gray-400 hover:text-white font-semibold pb-2">Courses</a>
        <a href="equip.php" class="text-gray-400 hover:text-white font-semibold pb-2">Equipment</a>
        <a href="dashboard.php" class="text-white font-semibold pb-2 border-b-2 border-red-600">Dashboard</a>
    </nav>

    <main class="p-8">
        <!-- Summary Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white text-black rounded-lg p-6 border-2 border-l-4 border-black">
                <p class="text-gray-700 text-sm uppercase tracking-wide">Total Courses</p>
                <p class="text-5xl font-bold mt-2"><?= $totalCourses ?></p>
            </div>
            <div class="bg-white text-black rounded-lg p-6 border-2 border-l-4 border-black">
                <p class="text-gray-700 text-sm uppercase tracking-wide">Total Equipment</p>
                <p class="text-5xl font-bold mt-2"><?= $totalEquipments ?></p>
            </div>
        </div>

        <!-- Charts Section -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Courses by Category Chart -->
            <div class="bg-white border-2 border-black rounded-lg p-8 shadow-lg">
                <h2 class="text-2xl font-bold text-black mb-6 pb-4 border-b-2 border-red-600">Répartition des Cours par Type</h2>
                <canvas id="coursesChart" class="max-h-96"></canvas>
            </div>

            <!-- Equipment by Type Chart -->
            <div class="bg-white border-2 border-black rounded-lg p-8 shadow-lg">
                <h2 class="text-2xl font-bold text-black mb-6 pb-4 border-b-2 border-red-600">Répartition des Équipements par Type</h2>
                <canvas id="equipmentChart" class="max-h-96"></canvas>
            </div>
        </div>
    </main>

    <script>
        // Courses by Category Chart
        const coursesCtx = document.getElementById('coursesChart').getContext('2d');
        const coursesChart = new Chart(coursesCtx, {
            type: 'doughnut',
            data: {
                labels: <?= json_encode(array_keys($coursesByCategory)) ?>,
                datasets: [{
                    data: <?= json_encode(array_values($coursesByCategory)) ?>,
                    backgroundColor: [
                        '#DC2626',
                        '#000000',
                        '#F5F5F5',
                        '#991B1B',
                        '#7F1D1D',
                        '#B91C1C'
                    ],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 13,
                                weight: 'bold'
                            }
                        }
                    }
                }
            }
        });

        // Equipment by Type Chart
        const equipmentCtx = document.getElementById('equipmentChart').getContext('2d');
        const equipmentChart = new Chart(equipmentCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_keys($equipmentsByType)) ?>,
                datasets: [{
                    label: 'Quantité',
                    data: <?= json_encode(array_values($equipmentsByType)) ?>,
                    backgroundColor: '#DC2626',
                    borderColor: '#000000',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: '#E5E7EB'
                        }
                    },
                    x: {
                        ticks: {
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script>
</body>

</html>
