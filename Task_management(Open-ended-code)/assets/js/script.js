// Task Management System - JavaScript

// Modal Management
function openAddModal() {
  document.getElementById("modalTitle").textContent = "Add New Task"
  document.getElementById("taskForm").reset()
  document.getElementById("task_id").value = ""
  document.getElementById("action").value = "create"
  document.getElementById("taskModal").classList.add("show")
}

function editTask(task) {
  document.getElementById("modalTitle").textContent = "Edit Task"
  document.getElementById("task_id").value = task.id
  document.getElementById("action").value = "update"
  document.getElementById("title").value = task.title
  document.getElementById("description").value = task.description || ""
  document.getElementById("status").value = task.status
  document.getElementById("priority").value = task.priority
  document.getElementById("due_date").value = task.due_date || ""
  document.getElementById("taskModal").classList.add("show")
}

function closeModal() {
  document.getElementById("taskModal").classList.remove("show")
}

function deleteTask(taskId, taskTitle) {
  if (confirm('Are you sure you want to delete "' + taskTitle + '"?')) {
    window.location.href = "task_actions.php?action=delete&id=" + taskId
  }
}

function filterTasks(status) {
  if (status === "all") {
    window.location.href = "dashboard.php"
  } else {
    window.location.href = "dashboard.php?status=" + status
  }
}

// Close modal when clicking outside
window.onclick = (event) => {
  const modal = document.getElementById("taskModal")
  if (event.target === modal) {
    closeModal()
  }
}

// Close modal on ESC key
document.addEventListener("keydown", (event) => {
  if (event.key === "Escape") {
    closeModal()
  }
})

// Auto-hide alerts after 5 seconds
document.addEventListener("DOMContentLoaded", () => {
  const alerts = document.querySelectorAll(".alert")
  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.style.transition = "opacity 0.5s"
      alert.style.opacity = "0"
      setTimeout(() => {
        alert.remove()
      }, 500)
    }, 5000)
  })
})
