<?php require 'config/config.php'; require 'courses.php'; require 'equipements.php'; ?>
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
        <!-- Courses Tab with table and form -->
        <div id="courses-tab" class="tab-content">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-6 rounded-lg border-2 border-black">
                        <h3 class="text-xl font-bold text-black mb-4">
                            <?= isset($courseEdit) && $courseEdit ? 'Update Course' : 'Add New Course' ?>
                        </h3>
                        <form method="POST" action="courses.php" class="space-y-4">
                            <input type="hidden" name="action" value="<?= isset($courseEdit) && $courseEdit ? 'update' : 'add' ?>">
                            <?php if (isset($courseEdit) && $courseEdit): ?>
                                <input type="hidden" name="id" value="<?= $courseEdit['id'] ?>">
                            <?php endif; ?>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Course Name</label>
                                <input type="text" name="fullname" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['fullname'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Category</label>
                                <input type="text" name="category" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['category'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Date</label>
                                <input type="date" name="date_c" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['course_date'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Time</label>
                                <input type="time" name="hour" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['heure'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Duration (hours)</label>
                                <input type="number" name="duree" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['duree'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Max Participants</label>
                                <input type="number" name="max_p" required value="<?= isset($courseEdit) && $courseEdit ? $courseEdit['max_participants'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 rounded hover:bg-red-700">
                                <?= isset($courseEdit) && $courseEdit ? 'Update Course' : 'Add Course' ?>
                            </button>
                            <?php if (isset($courseEdit) && $courseEdit): ?>
                                <a href="index.php" class="block text-center bg-black text-white font-bold py-2 rounded hover:bg-gray-800">Cancel</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-black mb-4">All Courses</h2>
                    <div class="overflow-x-auto">
                        <table class="w-full border-collapse">
                            <thead>
                                <tr class="bg-black text-white">
                                    <th class="px-4 py-3 text-left">ID</th>
                                    <th class="px-4 py-3 text-left">Name</th>
                                    <th class="px-4 py-3 text-left">Category</th>
                                    <th class="px-4 py-3 text-left">Date</th>
                                    <th class="px-4 py-3 text-left">Time</th>
                                    <th class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($courses as $course): ?>
                                    <tr class="border-b border-gray-300 hover:bg-red-50">
                                        <td class="px-4 py-3 text-black"><?= $course['id'] ?></td>
                                        <td class="px-4 py-3 text-black font-semibold"><?= $course['fullname'] ?></td>
                                        <td class="px-4 py-3 text-black"><?= $course['category'] ?></td>
                                        <td class="px-4 py-3 text-black"><?= $course['course_date'] ?></td>
                                        <td class="px-4 py-3 text-black"><?= $course['heure'] ?></td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="index.php?action=update&id=<?= $course['id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 mr-2">Edit</a>
                                            <a href="javascript:deleteItem('courses', <?= $course['id'] ?>)" class="bg-black text-white px-3 py-1 rounded text-sm border border-red-600 hover:bg-red-600">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Equipment Tab with table and form -->
        <div id="equipment-tab" class="tab-content hidden">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Form Section -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 p-6 rounded-lg border-2 border-black">
                        <h3 class="text-xl font-bold text-black mb-4">
                            <?= isset($equipToEdit) && $equipToEdit ? 'Update Equipment' : 'Add New Equipment' ?>
                        </h3>
                        <form method="POST" action="equipements.php" class="space-y-4">
                            <input type="hidden" name="action" value="<?= isset($equipToEdit) && $equipToEdit ? 'update' : 'add' ?>">
                            <?php if (isset($equipToEdit) && $equipToEdit): ?>
                                <input type="hidden" name="id" value="<?= $equipToEdit['id'] ?>">
                            <?php endif; ?>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Equipment Title</label>
                                <input type="text" name="title" required value="<?= isset($equipToEdit) && $equipToEdit ? $equipToEdit['title'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Type</label>
                                <input type="text" name="type" required value="<?= isset($equipToEdit) && $equipToEdit ? $equipToEdit['type'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Quantity</label>
                                <input type="number" name="quantite" required value="<?= isset($equipToEdit) && $equipToEdit ? $equipToEdit['quantite'] : '' ?>" class="w-full px-3 py-2 border-2 border-black rounded">
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-black mb-1">Status</label>
                                <select name="etat" required class="w-full px-3 py-2 border-2 border-black rounded">
                                    <option value="">Select Status</option>
                                    <option value="Excellent" <?= isset($equipToEdit) && $equipToEdit && $equipToEdit['etat'] === 'Excellent' ? 'selected' : '' ?>>Excellent</option>
                                    <option value="Good" <?= isset($equipToEdit) && $equipToEdit && $equipToEdit['etat'] === 'Good' ? 'selected' : '' ?>>Good</option>
                                    <option value="Fair" <?= isset($equipToEdit) && $equipToEdit && $equipToEdit['etat'] === 'Fair' ? 'selected' : '' ?>>Fair</option>
                                    <option value="Poor" <?= isset($equipToEdit) && $equipToEdit && $equipToEdit['etat'] === 'Poor' ? 'selected' : '' ?>>Poor</option>
                                </select>
                            </div>

                            <button type="submit" class="w-full bg-red-600 text-white font-bold py-2 rounded hover:bg-red-700">
                                <?= isset($equipToEdit) && $equipToEdit ? 'Update Equipment' : 'Add Equipment' ?>
                            </button>
                            <?php if (isset($equipToEdit) && $equipToEdit): ?>
                                <a href="index.php" class="block text-center bg-black text-white font-bold py-2 rounded hover:bg-gray-800">Cancel</a>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>

                <!-- Table Section -->
                <div class="lg:col-span-2">
                    <h2 class="text-2xl font-bold text-black mb-4">All Equipment</h2>
                    <div class="overflow-x-auto">
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
                            <tbody>
                                <?php foreach($equipements as $equip): ?>
                                    <tr class="border-b border-gray-300 hover:bg-red-50">
                                        <td class="px-4 py-3 text-black"><?= $equip['id'] ?></td>
                                        <td class="px-4 py-3 text-black font-semibold"><?= $equip['title'] ?></td>
                                        <td class="px-4 py-3 text-black"><?= $equip['type'] ?></td>
                                        <td class="px-4 py-3 text-black text-center"><?= $equip['quantite'] ?></td>
                                        <td class="px-4 py-3">
                                            <?php
                                            $statusClass = '';
                                            if ($equip['etat'] === 'Excellent') $statusClass = 'bg-green-100 text-green-800';
                                            elseif ($equip['etat'] === 'Good') $statusClass = 'bg-blue-100 text-blue-800';
                                            elseif ($equip['etat'] === 'Fair') $statusClass = 'bg-yellow-100 text-yellow-800';
                                            else $statusClass = 'bg-red-100 text-red-800';
                                            ?>
                                            <span class="px-2 py-1 rounded text-sm font-semibold <?= $statusClass ?>"><?= $equip['etat'] ?></span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <a href="index.php?action=update&id=<?= $equip['id'] ?>" class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700 mr-2">Edit</a>
                                            <a href="javascript:deleteItem('equipements', <?= $equip['id'] ?>)" class="bg-black text-white px-3 py-1 rounded text-sm border border-red-600 hover:bg-red-600">Delete</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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
    </style>

    <script>
        function showTab(tabName) {
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.add('hidden');
            });
            document.querySelectorAll('.tab-btn').forEach(btn => {
                btn.classList.remove('active', 'border-b-2', 'border-red-600');
                btn.classList.add('text-gray-400');
            });

            document.getElementById(tabName + '-tab').classList.remove('hidden');
            event.target.classList.add('active', 'border-b-2', 'border-red-600');
            event.target.classList.remove('text-gray-400');
            event.target.classList.add('text-white');
        }

        function deleteItem(type, id) {
            if (confirm('Are you sure you want to delete this item?')) {
                window.location.href = `${type}.php?action=delete&id=${id}`;
            }
        }
    </script>
</body>
</html>
