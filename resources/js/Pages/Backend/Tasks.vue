<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import { formattedDate, openFormModal } from "@/resuables";

const taskModalRef = ref(null);
const openModalTaskForm = () => {
    openFormModal(taskModalRef);
};

const taskForm = useForm({
    task_name: "",
    task_desc: "",
    project_id: "",
    assigned_user: "",
    priority: "",
    status: "",
    due_date: "",
});

const taskFormSubmit = () => {
    taskForm.post(route("tasks.store"));
};

const props = defineProps({
    projects: Array,
    users: Array,
    tasks: Array,
});
</script>

<script>
import AdminLayout from "@/Layout/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <Head tltle="Tasks" />
    <div
        class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center gap-2 mb-4"
    >
        <div>
            <h1 class="h4 fw-bold mb-1">Tasks</h1>
            <p class="text-muted mb-0">
                Create, assign, and track work across your projects.
            </p>
        </div>
        <button
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#taskModal"
            @click="openModalTaskForm"
        >
            <i class="fa-solid fa-plus"></i> New task
        </button>
    </div>

    <!-- Status summary -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">To do</div>
                    <div class="fs-3 fw-bold">12</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">In progress</div>
                    <div class="fs-3 fw-bold text-primary">8</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Completed</div>
                    <div class="fs-3 fw-bold text-success">31</div>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card h-100">
                <div class="card-body">
                    <div class="text-muted small">Overdue</div>
                    <div class="fs-3 fw-bold text-danger">3</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card mb-3">
        <div class="card-body">
            <form class="row g-2" onsubmit="return false;">
                <div class="col-12 col-lg-3">
                    <div class="input-group">
                        <span class="input-group-text bg-white"
                            ><i class="fa-solid fa-magnifying-glass"></i
                        ></span>
                        <input
                            type="search"
                            class="form-control"
                            placeholder="Search tasks"
                        />
                    </div>
                </div>
                <div class="col-6 col-lg-2">
                    <select class="form-select" aria-label="Filter by project">
                        <option value="">All projects</option>
                        <option>Website Redesign</option>
                        <option>Mobile App</option>
                        <option>Internal Tools</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <select class="form-select" aria-label="Filter by assignee">
                        <option value="">All assignees</option>
                        <option>Maria Santos</option>
                        <option>John Reyes</option>
                        <option>Ana Cruz</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <select class="form-select" aria-label="Filter by status">
                        <option value="">All statuses</option>
                        <option>To do</option>
                        <option>In progress</option>
                        <option>In review</option>
                        <option>Done</option>
                    </select>
                </div>
                <div class="col-6 col-lg-2">
                    <select class="form-select" aria-label="Filter by priority">
                        <option value="">All priorities</option>
                        <option>Low</option>
                        <option>Medium</option>
                        <option>High</option>
                        <option>Urgent</option>
                    </select>
                </div>
                <div class="col-12 col-lg-1 d-grid">
                    <button
                        type="reset"
                        class="btn btn-outline-secondary"
                        title="Clear filters"
                    >
                        <i class="fa-solid fa-filter-circle-xmark"></i> Clear
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tasks table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Task</th>
                        <th>Project</th>
                        <th>Assignee</th>
                        <th>Priority</th>
                        <th>Status</th>
                        <th>Due date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(task, index) in tasks">
                        <td>{{ index + 1 }}</td>
                        <td>{{ task.task_name }}</td>
                        <td>{{ task.project_name }}</td>
                        <td>{{ task.user_name }}</td>
                        <td>
                            <span
                                class="badge text-black bg-light"
                                v-if="task.priority === 1"
                                >Low</span
                            >
                            <span
                                class="badge text-black bg-info"
                                v-else-if="task.priority === 2"
                                >Medium</span
                            >
                            <span
                                class="badge text-white bg-warning"
                                v-else-if="task.priority === 3"
                                >High</span
                            >
                            <span
                                class="badge text-white bg-danger"
                                v-else-if="task.priority === 4"
                                >Urgent</span
                            >
                        </td>
                        <td>
                            <span
                                class="badge text-white bg-secondary"
                                v-if="task.status === 1"
                                >To do</span
                            >
                            <span
                                class="badge text-black bg-info"
                                v-else-if="task.status === 2"
                                >In progress</span
                            >
                            <span
                                class="badge text-white bg-warning"
                                v-else-if="task.status === 3"
                                >In review</span
                            >
                            <span
                                class="badge text-black bg-danger"
                                v-else-if="task.status === 4"
                                >Done</span
                            >
                        </td>
                        <td>{{ formattedDate(task.due_date) }}</td>
                        <td class="text-end">
                            <button
                                class="btn btn-sm btn-outline-secondary"
                                title="View"
                                data-bs-toggle="modal"
                                data-bs-target="#viewModal"
                                onclick="openView(this)"
                            >
                                <i class="fa-solid fa-eye"></i>
                            </button>
                            <button
                                class="btn btn-sm btn-outline-secondary"
                                title="Edit"
                                data-bs-toggle="modal"
                                data-bs-target="#taskModal"
                                onclick="openEdit(this)"
                            >
                                <i class="fa-solid fa-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div
        class="modal fade"
        ref="taskModalRef"
        tabindex="-1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    >
        <div class="modal-dialog modal-lg">
            <form @submit.prevent="taskFormSubmit">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Task Form</h4>
                        <button
                            type="button"
                            data-bs-dismiss="modal"
                            class="btn-close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Title</label>
                            <input
                                type="text"
                                class="form-control"
                                :class="{
                                    'is-invalid': taskForm.errors.task_name,
                                }"
                                v-model="taskForm.task_name"
                            />
                            <div class="invalid-feedback">
                                {{ taskForm.errors.task_name }}
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Description</label>
                            <textarea
                                name=""
                                class="form-control"
                                rows="7"
                                :class="{
                                    'is-invalid': taskForm.errors.task_desc,
                                }"
                                v-model="taskForm.task_desc"
                            ></textarea>
                            <div class="invalid-feedback">
                                {{ taskForm.errors.task_name }}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="">Project</label>
                                <v-select
                                    :options="projects"
                                    label="project_name"
                                    :reduce="(prj) => prj.id"
                                    placeholder="Select Project"
                                    v-model="taskForm.project_id"
                                >
                                </v-select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="">Assigned to</label>
                                <v-select
                                    :options="users"
                                    :class="{
                                        'is-invalid':
                                            taskForm.errors.assigned_user,
                                    }"
                                    :reduce="(user) => user.id"
                                    label="name"
                                    v-model="taskForm.assigned_user"
                                ></v-select>
                                <div class="invalid-feedback">
                                    {{ taskForm.errors.assigned_user }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="">Priority</label>
                                <select
                                    class="form-select"
                                    :class="{
                                        'is-invalid': taskForm.errors.priority,
                                    }"
                                    v-model="taskForm.priority"
                                >
                                    <option value="" selected>
                                        Select priority
                                    </option>
                                    <option value="1">Low</option>
                                    <option value="2">Medium</option>
                                    <option value="3">High</option>
                                    <option value="4">Urgent</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ taskForm.errors.priority }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Status</label>
                                <select
                                    class="form-select"
                                    :class="{
                                        'is-invalid': taskForm.errors.status,
                                    }"
                                    v-model="taskForm.status"
                                >
                                    <option value="" selected>
                                        Select status
                                    </option>
                                    <option value="1">To do</option>
                                    <option value="2">In progress</option>
                                    <option value="3">In review</option>
                                    <option value="4">Done</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ taskForm.errors.status }}
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Due Date</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': taskForm.errors.due_date,
                                    }"
                                    v-model="taskForm.due_date"
                                />
                                <div class="invalid-feedback">
                                    {{ taskForm.errors.due_date }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-outline-secondary px-3">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary px-3">
                            Save Task
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</template>
