<?php
require 'courses.php';

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
             <button onclick="showTab('courses')"
                class="tab-btn  font-semibold pb-2">
                <a href="index.php">
                Courses
                </a>
            </button>

            <button
                class="tab-btn  font-semibold pb-2 hover:text-white">
                <a href="equip.php">
                Equipment
                </a>
            </button>
        </div>
    </nav>

    <main class="p-8">
        <div id="courses-tab"
            class="tab-content <?= isset($_GET['tab']) && $_GET['tab'] === 'courses' ? 'hidden' : '' ?>">

            <?php if ($courseEdit): ?>
                <form action="courses.php" method="POST" class="max-w-xl bg-white shadow p-6 rounded-lg mb-10">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $courseEdit['id'] ?>">

                    <h2 class="text-xl font-bold mb-4">Edit Course</h2>

                    <input type="text" name="fullname" value="<?= $courseEdit['fullname'] ?>" placeholder="Full Name"
                        required class="w-full border p-2 rounded mb-3">
                    <input type="text" name="category" value="<?= $courseEdit['category'] ?>" placeholder="Category"
                        required class="w-full border p-2 rounded mb-3">
                    <input type="date" name="date_c" value="<?= $courseEdit['course_date'] ?>" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="time" name="hour" value="<?= $courseEdit['heure'] ?>" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="number" name="duree" value="<?= $courseEdit['duree'] ?>" placeholder="Duration" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="number" name="max_p" value="<?= $courseEdit['max_participants'] ?>"
                        placeholder="Max Participants" required class="w-full border p-2 rounded mb-3">

                    <button type="submit" class="mt-4 bg-black text-white px-4 py-2 rounded">Update Course</button>
                </form>

            <?php else: ?>

                <form action="courses.php" method="POST" class="max-w-xl bg-white shadow p-6 rounded-lg mb-10">
                    <input type="hidden" name="action" value="add">

                    <h2 class="text-xl font-bold mb-4">Add New Course</h2>

                    <input type="text" name="fullname" placeholder="Full Name" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="text" name="category" placeholder="Category" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="date" name="date_c" required class="w-full border p-2 rounded mb-3">
                    <input type="time" name="hour" required class="w-full border p-2 rounded mb-3">
                    <input type="number" name="duree" placeholder="Duration" required
                        class="w-full border p-2 rounded mb-3">
                    <input type="number" name="max_p" placeholder="Max Participants" required
                        class="w-full border p-2 rounded mb-3">

                    <button type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Add Course</button>
                </form>
            <?php endif; ?>



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
                        <?php foreach ($courses as $course): ?>
                            <tr class="border-b border-gray-300 hover:bg-red-50 transition">
                                <td class="px-4 py-3 text-sm text-black"><?= $course['id'] ?></td>
                                <td class="px-4 py-3 text-sm text-black font-medium">
                                    <?= htmlspecialchars($course['fullname']) ?>
                                </td>
                                <td class="px-4 py-3 text-sm text-black"><?= htmlspecialchars($course['category']) ?></td>
                                <td class="px-4 py-3 text-sm text-black"><?= htmlspecialchars($course['course_date']) ?>
                                </td>
                                <td class="px-4 py-3 text-sm text-black"><?= htmlspecialchars($course['heure']) ?></td>
                                <td class="px-4 py-3 text-sm text-black"><?= htmlspecialchars($course['duree']) ?></td>
                                <td class="px-4 py-3 text-sm text-black">
                                    <?= htmlspecialchars($course['max_participants']) ?>
                                </td>
                                <td class="px-4 py-3 text-center text-sm">
                                    <a href="index.php?action=update&id=<?= $course['id'] ?>" class="btn-edit">Edit</a>
                                    <a href="courses.php?action=delete&id=<?= $course['id'] ?>"
                                        class="btn-delete">Delete</a>
                                </td>
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
            display: inline-block;
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
            text-decoration: none;
            display: inline-block;
        }

        .btn-delete:hover {
            background-color: #dc2626;
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

    </script>
</body>

</html>