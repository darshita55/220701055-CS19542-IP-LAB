document.addEventListener('DOMContentLoaded', () => {
    const taskForm = document.getElementById('new-task-form');
    const tasksList = document.getElementById('tasks');
    const filterButtons = {
        all: document.getElementById('filter-all'),
        pending: document.getElementById('filter-pending'),
        completed: document.getElementById('filter-completed'),
    };

    let tasks = JSON.parse(localStorage.getItem('tasks')) || [];

    // Load tasks and render them on the page
    function loadTasks(filter = 'all') {
        tasksList.innerHTML = ''; // Clear the task list before re-rendering

        const filteredTasks = tasks.filter(task => {
            if (filter === 'pending') return !task.completed;
            if (filter === 'completed') return task.completed;
            return true;
        });

        if (filteredTasks.length === 0) {
            tasksList.innerHTML = '<li>No tasks found</li>';
        } else {
            filteredTasks.forEach(task => {
                const taskElement = document.createElement('li');
                taskElement.innerHTML = `
                    <input type="checkbox" ${task.completed ? 'checked' : ''} onchange="toggleComplete(${task.id})">
                    <span class="${task.completed ? 'completed' : ''}">${task.title}</span>
                    <button onclick="editTask(${task.id})">Edit</button>
                    <button onclick="deleteTask(${task.id})">Delete</button>
                `;
                tasksList.appendChild(taskElement);
            });
        }
    }

    // Add a new task to the list and localStorage
    taskForm.addEventListener('submit', (e) => {
        e.preventDefault();

        // Collect task details
        const taskTitle = document.getElementById('task-title').value;
        const taskDesc = document.getElementById('task-desc').value;
        const taskDueDate = document.getElementById('task-due-date').value;

        // Validate input (all fields must be filled)
        if (!taskTitle || !taskDesc || !taskDueDate) {
            alert('Please fill in all fields');
            return;
        }

        const newTask = {
            id: Date.now(), // Use a unique timestamp as the task ID
            title: taskTitle,
            description: taskDesc,
            dueDate: taskDueDate,
            completed: false,
        };

        // Add the new task to the tasks array and save it in localStorage
        tasks.push(newTask);
        localStorage.setItem('tasks', JSON.stringify(tasks));

        // Reload tasks to reflect the new task in the list
        loadTasks();
        taskForm.reset(); // Clear the form after submission
    });

    // Filter tasks based on the selected filter
    filterButtons.all.addEventListener('click', () => loadTasks('all'));
    filterButtons.pending.addEventListener('click', () => loadTasks('pending'));
    filterButtons.completed.addEventListener('click', () => loadTasks('completed'));

    // Toggle task completion
    window.toggleComplete = function (id) {
        const task = tasks.find(task => task.id === id);
        task.completed = !task.completed;
        localStorage.setItem('tasks', JSON.stringify(tasks));
        loadTasks();
    };

    // Edit task (load task details into the form for editing)
    window.editTask = function (id) {
        const task = tasks.find(task => task.id === id);
        document.getElementById('task-title').value = task.title;
        document.getElementById('task-desc').value = task.description;
        document.getElementById('task-due-date').value = task.dueDate;

        // Remove the task from the list to simulate edit (you can customize this behavior)
        tasks = tasks.filter(task => task.id !== id);
        localStorage.setItem('tasks', JSON.stringify(tasks));
        loadTasks();
    };

    // Delete a task
    window.deleteTask = function (id) {
        tasks = tasks.filter(task => task.id !== id);
        localStorage.setItem('tasks', JSON.stringify(tasks));
        loadTasks();
    };

    // Initial load of tasks on page load
    loadTasks();
});
