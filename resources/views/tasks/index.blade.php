<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal Task Manager</title>

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
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar h1 {
            font-size: 24px;
        }

        .container {
            width: 84%;
            max-width: 1100px;
            margin: 40px auto;
        }

        .top-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .top-section h2 {
            font-size: 28px;
        }

        .add-btn {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 12px 18px;
            border-radius: 8px;
            font-weight: bold;
        }

        .add-btn:hover {
            background: #1d4ed8;
        }

        .message {
            background: #dcfce7;
            color: #166534;
            padding: 14px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .task-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }

        .task-card {
            background: white;
            border-radius: 12px;
            padding: 22px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .task-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .description {
            color: #666;
            margin-bottom: 15px;
            min-height: 40px;
        }

        .status {
            display: inline-block;
            padding: 6px 10px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 12px;
        }

        .pending {
            background: #fef3c7;
            color: #92400e;
        }

        .completed {
            background: #dcfce7;
            color: #166534;
        }

        .due-date {
            color: #555;
            margin-bottom: 18px;
            font-size: 14px;
        }

        .actions {
            display: flex;
            gap: 8px;
            flex-wrap: wrap;
        }

        .actions a,
        .actions button {
            border: none;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 14px;
        }

        .complete-btn {
            background: #16a34a;
            color: white;
        }

        .edit-btn {
            background: #2563eb;
            color: white;
        }

        .delete-btn {
            background: #dc2626;
            color: white;
        }

        .empty {
            background: white;
            padding: 50px;
            text-align: center;
            border-radius: 12px;
            color: #777;
        }

        @media (max-width: 600px) {
            .navbar {
                padding: 18px 5%;
            }

            .container {
                width: 90%;
            }

            .top-section {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }
        }
    </style>
</head>

<body>

    <nav class="navbar">
        <h1>My Task Manager</h1>
        <span>Stay organized. Stay productive.</span>
    </nav>

    <div class="container">

        <div class="top-section">
            <h2>My Tasks</h2>

           <a href="/tasks/create" class="add-btn">
    + Add Task
</a>
        </div>

        @if(session('success'))
            <div class="message">
                {{ session('success') }}
            </div>
        @endif

        @if($tasks->count() > 0)

            <div class="task-grid">

                @foreach($tasks as $task)

                    <div class="task-card">

                        <h3>{{ $task->task_name }}</h3>

                        <p class="description">
                            {{ $task->description ?: 'No description provided.' }}
                        </p>

                        <span class="status {{ $task->status === 'Completed' ? 'completed' : 'pending' }}">
                            {{ $task->status }}
                        </span>

                        <p class="due-date">
                            Due:
                            {{ $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('M d, Y') : 'No due date' }}
                        </p>

                        <div class="actions">

                            <form action="/tasks/{{ $task->id }}/complete" method="POST">
                                @csrf
                                @method('PATCH')

                                <button type="submit" class="complete-btn">
                                    {{ $task->status === 'Completed' ? 'Mark Pending' : 'Complete' }}
                                </button>
                            </form>

                            <a href="/tasks/{{ $task->id }}/edit" class="edit-btn">
                                Edit
                            </a>

                            <form action="/tasks/{{ $task->id }}" method="POST"
                                  onsubmit="return confirm('Are you sure you want to delete this task?');">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="delete-btn">
                                    Delete
                                </button>
                            </form>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            <div class="empty">
                <h3>No tasks yet</h3>
                <p>Click "Add Task" to create your first task.</p>
            </div>

        @endif

    </div>

</body>
</html>