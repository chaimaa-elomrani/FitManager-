<?php
require 'courses.php';
require 'equipment.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course & Equipment Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white">
    <header class="bg-black text-white py-6 px-8">
        <h1 class="text-3xl font-bold">Management System</h1>
        <p class="text-red-500 mt-2">Course & Equipment Dashboard</p>
    </header>

    <nav class="bg-black border-b-4 border-red-600 px-8 py-4">
        <div class="flex gap-8">
            <button onclick="showTab('courses')" class="tab-btn active text-white font-semibold pb-2 border-b-2 border-red-600">
                Courses
            </button>
            <button onclick="showTab('equipment')" class="tab-btn text-gray-400 font-semibold pb-2 hover:text-white">
                Equipment
            </button>
        </div>
    </nav>

    <main class="p-8">
        <div id="courses-tab" class="tab-content">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-black mb-4">Courses</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-black text-white">
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Name</th>
                            <th class="px-4 py-3 text-left">Category</th>
                            <th class="px-4 py-3 text-left">Date</th>
                            <th class="px-4 py-3 text-left">Time</th>
                            <th class="px-4 py-3 text-left">Duration</th>
                            <th class="px-4 py-3 text-left">Max Participants</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="courses-tbody">
                        <?php foreach($courses as $course): ?>
                        <tr class="border-b border-gray-300 hover:bg-red-50 transition">
                            <td class="px-4 py-3 text-sm text-black"><?= $course['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-black font-medium"><?= $course['fullname'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $course['category'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $course['course_date'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $course['heure'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $course['duree'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $course['max_participants'] ?></td>
                            <td class="px-4 py-3 text-center text-sm">
                                <a href="courses.php?action=update&id=<?= $course['id'] ?>" class="btn-edit">Edit</a>
                                <a href="courses.php?action=delete&id=<?= $course['id'] ?>" class="btn-delete">Delete</a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div id="equipment-tab" class="tab-content hidden">
            <div class="mb-6">
                <h2 class="text-2xl font-bold text-black mb-4">Equipment</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-black text-white">
                            <th class="px-4 py-3 text-left">ID</th>
                            <th class="px-4 py-3 text-left">Title</th>
                            <th class="px-4 py-3 text-left">Type</th>
                            <th class="px-4 py-3 text-left">Quantity</th>
                            <th class="px-4 py-3 text-left">Status</th>
                            <th class="px-4 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="equipment-tbody">
                        <?php foreach($equipements as $equip): ?>
                        <tr class="border-b border-gray-300 hover:bg-red-50 transition">
                            <td class="px-4 py-3 text-sm text-black"><?= $equip['id'] ?></td>
                            <td class="px-4 py-3 text-sm text-black font-medium"><?= $equip['title'] ?></td>
                            <td class="px-4 py-3 text-sm text-black"><?= $equip['type'] ?></td>
                            <td class="px-4 py-3 text-sm text-black text-center"><?= $equip['quantite'] ?></td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-3 py-1 rounded text-white text-xs font-semibold <?= $equip['etat'] === 'Excellent' ? 'bg-green-600' : ($equip['etat'] === 'Good' ? 'bg-blue-600' : 'bg-red-600') ?>">
                                    <?= $equip['etat'] ?>
                                </span>
                            </td>
                            <!-- <td class="px-4 py-3 text-center text-sm">
                                <a href="courses.php?action=update&id=<?= $equip['id'] ?>" class="btn-edit">Edit</a>
                                <a href="courses.php?action=delete&id=<?= $equip['id'] ?>" class="btn-delete">Delete</a>
                            </td> -->
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    <style>
        .tab-btn.active {
            border-bottom: 3px solid #dc2626;
        }
        tbody tr:nth-child(even) {
            background-color: #f5f5f5;
        }
        tbody tr:hover {
            background-color: #efefef;
        }
        .btn-edit {
            background-color: #dc2626;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            margin-right: 0.5rem;
            text-decoration: none;
            font-size: 0.875rem;
        }
        .btn-edit:hover {
            background-color: #b91c1c;
        }
        .btn-delete {
            background-color: #000;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            border: 1px solid #dc2626;
            cursor: pointer;
            font-size: 0.875rem;
        }
        .btn-delete:hover {
            background-color: #dc2626;
        }
    </style>

    <script>
        function showTab(tabName) {
            // Hide all tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-b-2', 'border-red-600');
                btn.classList.add('text-gray-400');
            });

            // Show selected tab
            document.getElementById(tabName + '-tab').classList.remove('hidden');
            event.target.classList.add('active', 'border-b-2', 'border-red-600');
            event.target.classList.remove('text-gray-400');
            event.target.classList.add('text-white');
        }

    </script>
</body>
</html>
