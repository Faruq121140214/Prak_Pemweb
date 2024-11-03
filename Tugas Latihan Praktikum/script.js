// Inisialisasi daftar tugas dari localStorage atau buat array kosong
let tasks = JSON.parse(localStorage.getItem("tasks")) || [];
const taskList = document.getElementById("taskList");
const taskForm = document.getElementById("taskForm");

// Fungsi untuk menyimpan tugas ke localStorage
function saveTasks() {
    localStorage.setItem("tasks", JSON.stringify(tasks));
}

// Fungsi untuk menampilkan tugas
function renderTasks(filter = "all") {
    taskList.innerHTML = "";
    let filteredTasks = tasks;

    if (filter === "active") {
        filteredTasks = tasks.filter(task => !task.completed);
    } else if (filter === "completed") {
        filteredTasks = tasks.filter(task => task.completed);
    }

    filteredTasks.forEach(task => {
        const taskItem = document.createElement("li");
        taskItem.className = "task-item" + (task.completed ? " completed" : "");
        taskItem.innerHTML = `
            <span class="${task.priority === 'Tinggi' ? 'priority-high' : task.priority === 'Sedang' ? 'priority-medium' : 'priority-low'}">
                ${task.title} (Jatuh Tempo: ${task.dueDate || "Tidak ditentukan"})
            </span>
            <div>
                <button onclick="toggleComplete(${task.id})">Selesai</button>
                <button onclick="deleteTask(${task.id})">Hapus</button>
            </div>
        `;
        taskList.appendChild(taskItem);
    });
}

// Tambah tugas baru
taskForm.addEventListener("submit", event => {
    event.preventDefault();
    const title = document.getElementById("taskTitle").value;
    const dueDate = document.getElementById("taskDueDate").value;
    const priority = document.getElementById("taskPriority").value;

    const newTask = {
        id: Date.now(),
        title,
        dueDate,
        priority,
        completed: false
    };

    tasks.push(newTask);
    saveTasks();
    renderTasks();
    taskForm.reset();
});

// Toggle status selesai
function toggleComplete(id) {
    const task = tasks.find(task => task.id === id);
    task.completed = !task.completed;
    saveTasks();
    renderTasks();
}

// Hapus tugas
function deleteTask(id) {
    tasks = tasks.filter(task => task.id !== id);
    saveTasks();
    renderTasks();
}

// Filter tugas
function filterTasks(status) {
    // Menghapus kelas 'active' dari semua tombol
    const buttons = document.querySelectorAll(".filters button");
    buttons.forEach(button => {
        button.classList.remove("active");
    });

    // Menambahkan kelas 'active' pada tombol yang dipilih
    const activeButton = document.querySelector(`.filters button[onclick="filterTasks('${status}')"]`);
    if (activeButton) {
        activeButton.classList.add("active");
    }

    // Render tugas sesuai status
    renderTasks(status);
}

// Inisialisasi tampilan
renderTasks();