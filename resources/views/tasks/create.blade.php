<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            color: #222;
        }

        .navbar {
            background: #1f2937;
            color: white;
            padding: 20px 8%;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .container {
            width: 90%;
            max-width: 700px;
            margin: 40px auto;
        }

        .form-card {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .form-card h2 {
            margin-bottom: 25px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 15px;
        }

        textarea {
            min-height: 120px;
            resize: vertical;
        }

        input:focus,
        textarea:focus {
            outline: none;
            border-color: #2563eb;
        }

        .buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .save-btn,
        .back-btn {
            border: none;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
        }

        .save-btn {
            background: #2563eb;
            color: white;
        }

        .save-btn:hover {
            background: #1d4ed8;
        }

        .back-btn {
            background: #e5e7eb;
            color: #374151;
        }

        .error {
            background: #fee2e2;
            color: #991b1b;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h1>My Task Manager</h1>
    </nav>

    <div class="container">

        <div class="form-card">

            <h2>Add New Task</h2>

            @if($errors->any())
                <div class="error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="/tasks" method="POST">

                @csrf

                <div class="form-group">
                    <label for="task_name">Task Name</label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ old('task_name') }}"
                        placeholder="Enter task name"
                        required
                    >
                </div>

                <div class="form-group">
                    <label for="description">Description</label>

                    <textarea
                        id="description"
                        name="description"
                        placeholder="Enter task details..."
                    >{{ old('description') }}</textarea>
                </div>

                <div class="form-group">
                    <label for="due_date">Due Date</label>

                    <input
                        type="date"
                        id="due_date"
                        name="due_date"
                        value="{{ old('due_date') }}"
                    >
                </div>

                <div class="buttons">

                    <button type="submit" class="save-btn">
                        Add Task
                    </button>

                    <a href="/tasks" class="back-btn">
    Cancel
</a>
                        

                </div>

            </form>

        </div>

    </div>

</body>
</html>