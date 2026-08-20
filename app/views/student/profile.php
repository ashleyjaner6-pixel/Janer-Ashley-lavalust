<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 90%;
            max-width: 850px;
            margin: 60px auto;
            background: white;
            padding: 32px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            margin-top: 0;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 24px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            width: 32%;
            background: #f0f2f4;
            color: #333;
        }

        ul {
            margin: 12px 0 0;
            padding-left: 22px;
        }

        li {
            margin: 8px 0;
        }

        .btn {
            display: inline-block;
            margin-top: 24px;
            padding: 12px 20px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        .btn:hover {
            background: #555;
        }
    </style>
</head>

<body>
<div class="container">
    <h1>Student Profile</h1>

    <table>
        <tr>
            <th>Student No.</th>
            <td><?= htmlspecialchars($student['student_no']); ?></td>
        </tr>
        <tr>
            <th>Name</th>
            <td><?= htmlspecialchars($student['name']); ?></td>
        </tr>
        <tr>
            <th>Course</th>
            <td><?= htmlspecialchars($student['course']); ?></td>
        </tr>
        <tr>
            <th>Year Level</th>
            <td><?= htmlspecialchars($student['year_level']); ?></td>
        </tr>
        <tr>
            <th>Section</th>
            <td><?= htmlspecialchars($student['section']); ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($student['email']); ?></td>
        </tr>
        <tr>
            <th>Address</th>
            <td><?= htmlspecialchars($student['address']); ?></td>
        </tr>
    </table>

    <h2>Subjects</h2>
    <ul>
        <?php foreach ($subjects as $subject): ?>
            <li><?= htmlspecialchars($subject); ?></li>
        <?php endforeach; ?>
    </ul>

    <a href="<?= site_url('student'); ?>" class="btn">Back to Student Page</a>
</div>
</body>
</html>
