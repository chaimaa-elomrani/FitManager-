<?php
require 'equipmentController.php';
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
            <a href="index.php" class="tab-btn text-gray-400 font-semibold pb-2 hover:text-white">
                Courses
            </a>
            <a href="equip.php" class="tab-btn active text-white font-semibold pb-2 border-b-2 border-red-600">
                Equipment
            </a>
        </div>
    </nav>

    <main class="p-8">
        <div id="equipment-tab" class="tab-content">

            <?php if ($equipToEdit): ?>
                <!-- EDIT EQUIPMENT FORM -->
                <form action="equipmentController.php" method="POST" class="max-w-xl bg-white shadow p-6 rounded-lg mb-10">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?= $equipToEdit['id'] ?>">

                    <h2 class="text-xl font-bold mb-4">Edit Equipment</h2>

                    <input type="text" name="title" value="<?= htmlspecialchars($equipToEdit['title']) ?>"
                        placeholder="Title" required class="w-full border p-2 rounded mb-3">

                    <input type="text" name="type" value="<?= htmlspecialchars($equipToEdit['type']) ?>" 
                        placeholder="Type" required class="w-full border p-2 rounded mb-3">

                    <input type="number" name="quantite" value="<?= htmlspecialchars($equipToEdit['quantite']) ?>"
                        placeholder="Quantity" required class="w-full border p-2 rounded mb-3">

                    <select name="etat" required class="w-full border p-2 rounded mb-3">
                        <option value="">Select Status</option>
                        <option value="bon" <?= $equipToEdit['etat'] === 'bon' ? 'selected' : '' ?>>Bon</option>
                        <option value="moyen" <?= $equipToEdit['etat'] === 'moyen' ? 'selected' : '' ?>>Moyen</option>
                        <option value="a_remplacer" <?= $equipToEdit['etat'] === 'a_remplacer' ? 'selected' : '' ?>>À Remplacer</option>
                    </select>

                    <div class="flex gap-3">
                        <button type="submit" class="mt-4 bg-black text-white px-4 py-2 rounded">Update Equipment</button>
                        <a href="equip.php" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded inline-block">Cancel</a>
                    </div>
                </form>

            <?php else: ?>
                <!-- ADD EQUIPMENT FORM -->
                <form action="equipmentController.php" method="POST" class="max-w-xl bg-white shadow p-6 rounded-lg mb-10">
                    <input type="hidden" name="action" value="add">

                    <h2 class="text-xl font-bold mb-4">Add New Equipment</h2>

                    <input type="text" name="title" placeholder="Title" required class="w-full border p-2 rounded mb-3">

                    <input type="text" name="type" placeholder="Type" required class="w-full border p-2 rounded mb-3">

                    <input type="number" name="quantite" placeholder="Quantity" required
                        class="w-full border p-2 rounded mb-3">

                    <select name="etat" required class="w-full border p-2 rounded mb-3">
                        <option value="">Select Status</option>
                        <option value="bon">Bon</option>
                        <option value="moyen">Moyen</option>
                        <option value="a_remplacer">À Remplacer</option>
                    </select>

                    <button type="submit" class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Add Equipment</button>
                </form>
            <?php endif; ?>

            <!-- EQUIPMENT TABLE -->
            <div class="mb-6">
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
                            <?php foreach ($equipements as $equip): ?>
                                <?php
                                // Status color logic
                                $statusClass = '';
                                switch ($equip['etat']) {
                                    case 'bon':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'moyen':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'a_remplacer':
                                        $statusClass = 'bg-red-100 text-red-800';
                                        break;
                                    default:
                                        $statusClass = 'bg-gray-100 text-gray-800';
                                }
                                
                                // Display text
                                $statusDisplay = '';
                                switch ($equip['etat']) {
                                    case 'bon':
                                        $statusDisplay = 'Bon';
                                        break;
                                    case 'moyen':
                                        $statusDisplay = 'Moyen';
                                        break;
                                    case 'a_remplacer':
                                        $statusDisplay = 'À Remplacer';
                                        break;
                                    default:
                                        $statusDisplay = $equip['etat'];
                                }
                                ?>
                                <tr class="border-b border-gray-300 hover:bg-red-50">
                                    <td class="px-4 py-3 text-black"><?= htmlspecialchars($equip['id']) ?></td>
                                    <td class="px-4 py-3 text-black font-semibold"><?= htmlspecialchars($equip['title']) ?></td>
                                    <td class="px-4 py-3 text-black"><?= htmlspecialchars($equip['type']) ?></td>
                                    <td class="px-4 py-3 text-black text-center"><?= htmlspecialchars($equip['quantite']) ?></td>
                                    <td class="px-4 py-3">
                                        <span class="px-2 py-1 rounded text-sm font-semibold <?= $statusClass ?>">
                                            <?= $statusDisplay ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <a href="equip.php?action=update&id=<?= $equip['id'] ?>"
                                            class="btn-edit">Edit</a>
                                        <a href="equipmentController.php?action=delete&id=<?= $equip['id'] ?>"
                                            onclick="return confirm('Are you sure you want to delete this equipment?')"
                                            class="btn-delete">Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <style>
        .tab-btn {
            text-decoration: none;
            display: inline-block;
        }

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
</body>

</html>