<script setup>
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from "vue";
import {
    openFormModal,
    closeModal,
    dropdownToggle,
    formattedDate,
} from "@/resuables";

const projectModalFormRef = ref(null);
const projectModalViewRef = ref(null);
const openModalProjectForm = () => {
    openFormModal(projectModalFormRef);
};

const getProjectName = ref(null);
const getProjectDesc = ref(null);
const getProjectStatus = ref(null);
const getStartDate = ref(null);
const getDuteDate = ref(null);
const openModalProjectView = (project) => {
    openFormModal(projectModalViewRef);
    getProjectName.value = project.project_name;
    getProjectDesc.value = project.project_desc;
    getProjectStatus.value = project.status;
    getStartDate.value = project.start_date;
    getDuteDate.value = project.due_date;
};

const closeFormModal = () => {
    closeModal(projectModalFormRef);
};

const toggleDrop = (target) => {
    dropdownToggle(target);
};

const projectForm = useForm({
    project_name: "",
    project_desc: "",
    status: "",
    start_date: "",
    due_date: "",
    created_by: "",
});

const projectFormMode = ref("create");

const fetchProjectDetails = (project) => {
    openFormModal(projectModalFormRef);
    projectFormMode.value = "edit";
    projectForm.id = project.id;
    projectForm.project_name = project.project_name;
    projectForm.project_desc = project.project_desc;
    projectForm.status = project.status;
    projectForm.start_date = project.start_date;
    projectForm.due_date = project.due_date;
    projectForm.created_by = project.created_by;
};

const submitProjectForm = () => {
    if (projectFormMode.value === "create") {
        projectFormMode.value = "create";
        projectForm.post(route("project.store"), {
            onSuccess: () => {
                closeFormModal();
            },
        });
    } else {
        projectFormMode.value = "edit";
        projectForm.post(route("project.update", projectForm.id), {
            onSuccess: () => {
                closeFormModal();
            },
        });
    }
};

const props = defineProps({
    projects: Array,
});
</script>

<script>
import AdminLayout from "@/Layout/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <Head title="Projects" />
    <div
        class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4"
    >
        <div>
            <h1 class="h4 fw-semibold mb-1">Projects</h1>
            <p class="text-secondary mb-0">
                Track progress, deadlines, and who is working on what.
            </p>
        </div>
        <button class="btn btn-primary" @click="openModalProjectForm">
            <i class="bi bi-plus-lg me-1"></i> New project
        </button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-primary-subtle text-primary"
                        ><i class="bi bi-folder2-open"></i
                    ></span>
                    <div>
                        <div class="text-secondary small">Total projects</div>
                        <div class="h4 mb-0" id="statTotal">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-success-subtle text-success"
                        ><i class="bi bi-play-circle"></i
                    ></span>
                    <div>
                        <div class="text-secondary small">Active</div>
                        <div class="h4 mb-0" id="statActive">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-warning-subtle text-warning"
                        ><i class="bi bi-pause-circle"></i
                    ></span>
                    <div>
                        <div class="text-secondary small">On hold</div>
                        <div class="h4 mb-0" id="statHold">0</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-xl-3">
            <div class="card h-100">
                <div class="card-body d-flex align-items-center gap-3">
                    <span class="stat-icon bg-secondary-subtle text-secondary"
                        ><i class="bi bi-check-circle"></i
                    ></span>
                    <div>
                        <div class="text-secondary small">Completed</div>
                        <div class="h4 mb-0" id="statDone">0</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-2 align-items-center">
                <div class="col-12 col-md-5 col-xl-4">
                    <div class="input-group">
                        <span class="input-group-text bg-white"
                            ><i class="fa-solid fa-magnifying-glass"></i
                        ></span>
                        <input
                            type="search"
                            class="form-control"
                            id="searchInput"
                            placeholder="Search projects"
                        />
                    </div>
                </div>
                <div class="col-6 col-md-3 col-xl-2">
                    <select
                        class="form-select"
                        id="statusFilter"
                        aria-label="Filter by status"
                    >
                        <option value="">All statuses</option>
                        <option>Planning</option>
                        <option>Active</option>
                        <option>On hold</option>
                        <option>Completed</option>
                    </select>
                </div>
                <div class="col-6 col-md-3 col-xl-2">
                    <select
                        class="form-select"
                        id="sortSelect"
                        aria-label="Sort projects"
                    >
                        <option value="due">Due date</option>
                        <option value="name">Name</option>
                        <option value="progress">Progress</option>
                    </select>
                </div>
                <div class="col-12 col-md-auto ms-md-auto">
                    <div
                        class="btn-group view-toggle"
                        role="group"
                        aria-label="Switch view"
                    >
                        <button
                            type="button"
                            class="btn btn-outline-secondary active"
                            id="btnGrid"
                        >
                            <i class="bi bi-grid-3x3-gap me-1"></i> Cards
                        </button>
                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            id="btnList"
                        >
                            <i class="bi bi-list-ul me-1"></i> Table
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div class="row g-3"></div> -->

    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead class="table-light">
                <tr class="text-center">
                    <th>#</th>
                    <th>Project</th>
                    <th>Status</th>
                    <th style="min-width: 160px">Progress</th>
                    <th>Tasks</th>
                    <th>Due date</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr
                    class="text-center"
                    v-for="(project, index) in projects"
                    :key="index"
                >
                    <td>{{ index + 1 }}</td>
                    <td class="text-start">{{ project.project_name }}</td>
                    <td>
                        <span
                            class="badge bg-info-subtle text-info-emphasis"
                            v-if="project.status === 'planning'"
                            >Planning</span
                        >
                        <span
                            class="badge bg-primary-subtle text-primary-emphasis"
                            v-else-if="project.status === 'active'"
                            >Active</span
                        >
                        <span
                            class="badge bg-warning-subtle text-warning-emphasis"
                            v-else-if="project.status === 'hold'"
                            >On Hold</span
                        >
                        <span
                            class="badge bg-success-subtle text-success-emphasis"
                            v-else-if="project.status === 'completed'"
                            >Completed</span
                        >
                        <span
                            class="badge bg-secondary-subtle text-secondary-emphasis"
                            v-else-if="project.status === 'archived'"
                            >Archived</span
                        >
                    </td>
                    <td style="min-width: 160px">Progress</td>
                    <td>Tasks</td>
                    <td>
                        <span v-if="project.start_date && project.due_date"
                            >{{ formattedDate(project.start_date) }} ->
                            {{ formattedDate(project.due_date) }}</span
                        >
                        <span v-else>No Date as of yet</span>
                    </td>
                    <td class="text-end">
                        <div class="dropdown">
                            <button
                                type="button"
                                class="btn btn-sm btn-light dropdown-toggle"
                                aria-expanded="false"
                                aria-label="Project actions"
                                data-bs-toggle="dropdown"
                                data-bs-popper-config='{"strategy":"fixed"}'
                                @click="toggleDrop"
                            >
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a
                                        class="dropdown-item"
                                        href="#"
                                        @click.prevent="
                                            openModalProjectView(project)
                                        "
                                    >
                                        <i class="bi bi-eye me-2"></i>View
                                        project
                                    </a>
                                </li>
                                <li>
                                    <button
                                        class="dropdown-item"
                                        @click="fetchProjectDetails(project)"
                                    >
                                        <i class="bi bi-pencil me-2"></i>Edit
                                    </button>
                                </li>
                                <li><hr class="dropdown-divider" /></li>
                                <li>
                                    <button
                                        class="dropdown-item text-danger"
                                        @click="archiveProject(p)"
                                    >
                                        <i class="bi bi-trash me-2"></i>Archive
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- Create and Update Form -->
    <div
        class="modal fade"
        ref="projectModalFormRef"
        tabindex="-1"
        aria-hidden="true"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    >
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title h5" id="projectModalTitle">
                        New project
                    </h2>
                    <button
                        type="button"
                        class="btn-close"
                        @click="closeFormModal"
                        aria-label="Close"
                    ></button>
                </div>
                <form @submit.prevent="submitProjectForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
                                <input type="hidden" v-model="projectForm.id" />
                                <label for="projName" class="form-label"
                                    >Project name
                                    <span class="text-danger">*</span></label
                                >
                                <input
                                    type="text"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            projectForm.errors.project_name,
                                    }"
                                    v-model="projectForm.project_name"
                                />
                                <div class="invalid-feedback">
                                    {{ projectForm.errors.project_name }}
                                </div>
                            </div>
                            <div class="col-12">
                                <label for="projDesc" class="form-label"
                                    >Description</label
                                >
                                <textarea
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            projectForm.errors.project_desc,
                                    }"
                                    rows="3"
                                    placeholder="What is this project about?"
                                    v-model="projectForm.project_desc"
                                ></textarea>
                                <div class="invalid-feedback">
                                    {{ projectForm.errors.project_desc }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="projStatus" class="form-label"
                                    >Status</label
                                >
                                <select
                                    class="form-select"
                                    v-model="projectForm.status"
                                    :class="{
                                        'is-invalid': projectForm.errors.status,
                                    }"
                                >
                                    <option value="planning">Planning</option>
                                    <option value="active">Active</option>
                                    <option value="hold">On hold</option>
                                    <option value="completed">Completed</option>
                                </select>
                                <div class="invalid-feedback">
                                    {{ projectForm.errors.status }}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="projStart" class="form-label"
                                    >Start date</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="projectForm.start_date"
                                />
                            </div>
                            <div class="col-md-4">
                                <label for="projDue" class="form-label"
                                    >Due date</label
                                >
                                <input
                                    type="date"
                                    class="form-control"
                                    v-model="projectForm.due_date"
                                />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-outline-secondary"
                            @click="closeFormModal"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary">
                            Save project
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div
        class="modal fade"
        ref="projectModalViewRef"
        tabindex="-1"
        aria-labelledby="viewName"
        aria-hidden="true"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    >
        <div
            class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable"
        >
            <div class="modal-content">
                <div class="modal-header align-items-start">
                    <div>
                        <span
                            class="badge bg-info-subtle text-info-emphasis"
                            v-if="getProjectStatus === 'planning'"
                            >Planning</span
                        >
                        <span
                            class="badge bg-primary-subtle text-primary-emphasis"
                            v-else-if="getProjectStatus === 'active'"
                            >Active</span
                        >
                        <span
                            class="badge bg-warning-subtle text-warning-emphasis"
                            v-else-if="getProjectStatus === 'hold'"
                            >On Hold</span
                        >
                        <span
                            class="badge bg-success-subtle text-success-emphasis"
                            v-else-if="getProjectStatus === 'completed'"
                            >Completed</span
                        >
                        <span
                            class="badge bg-secondary-subtle text-secondary-emphasis"
                            v-else-if="getProjectStatus === 'archived'"
                            >Archived</span
                        >
                        <h2 class="modal-title">{{ getProjectName }}</h2>
                    </div>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <p class="text-secondary">{{ getProjectDesc }}</p>
                    <div class="row g-3 mb-4">
                        <div class="col-6 col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="text-secondary small">Progress</div>
                                <div class="h5 mb-0" id="viewProgress"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="text-secondary small">
                                    Tasks done
                                </div>
                                <div class="h5 mb-0" id="viewTasks"></div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="text-secondary small">
                                    Start date
                                </div>
                                <div class="fw-semibold">
                                    <span v-if="getStartDate">
                                        {{ formattedDate(getStartDate) }}
                                    </span>
                                    <span v-else>No Date</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-md-3">
                            <div class="border rounded-3 p-3 h-100">
                                <div class="text-secondary small">Due date</div>
                                <div class="fw-semibold">
                                    <span v-if="getDuteDate">
                                        {{ formattedDate(getDuteDate) }}
                                    </span>
                                    <span v-else>No Date</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <h3 class="h6 fw-semibold">Task breakdown</h3>
                    <div
                        class="progress mb-2"
                        style="height: 10px"
                        id="viewBreakdown"
                    ></div>
                    <div
                        class="d-flex flex-wrap gap-3 small text-secondary mb-4"
                    >
                        <span
                            ><i
                                class="bi bi-circle-fill text-secondary-emphasis me-1"
                                style="font-size: 0.5rem"
                            ></i
                            >To do: <strong id="viewTodo"></strong
                        ></span>
                        <span
                            ><i
                                class="bi bi-circle-fill text-primary me-1"
                                style="font-size: 0.5rem"
                            ></i
                            >In progress: <strong id="viewDoing"></strong
                        ></span>
                        <span
                            ><i
                                class="bi bi-circle-fill text-success me-1"
                                style="font-size: 0.5rem"
                            ></i
                            >Done: <strong id="viewDone"></strong
                        ></span>
                    </div>

                    <div
                        class="d-flex justify-content-between align-items-center mb-2"
                    >
                        <h3 class="h6 fw-semibold mb-0">Recent tasks</h3>
                        <a href="#" class="small text-decoration-none"
                            >View all tasks</a
                        >
                    </div>
                    <ul
                        class="list-group list-group-flush"
                        id="viewTaskList"
                    ></ul>
                </div>
                <div class="modal-footer">
                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        data-bs-dismiss="modal"
                    >
                        Close
                    </button>
                    <button
                        type="button"
                        class="btn btn-outline-primary"
                        id="viewEditBtn"
                    >
                        <i class="bi bi-pencil me-1"></i>Edit project
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
