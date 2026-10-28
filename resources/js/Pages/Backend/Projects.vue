<script setup>
import { useForm } from "@inertiajs/vue3";
import { Modal } from "bootstrap";
import { nextTick, ref } from "vue";

const modalProjectRef = ref(null);
let modalInstanceFormProject = null;

const projectFormModal = () => {
    nextTick(() => {
        modalInstanceFormProject = new Modal(modalProjectRef.value);
        modalInstanceFormProject.show();
    });
};

const openModalProjectForm = () => {
    projectFormModal();
};

const closeFormModal = () => {
    modalInstanceFormProject?.hide();
};

const projectForm = useForm({
    project_name: "",
    project_desc: "",
    status: "",
    priority: "",
    start_date: "",
    due_date: "",
    created_by: "",
});

const submitProjectForm = () => {
    projectForm.post(route("project.store"), {
        onSuccess: () => {
            closeFormModal();
        },
        onError: () => {
            alert("Error");
        },
    });
};
</script>

<script>
import AdminLayout from "@/Layout/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>
<template>
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

    <div class="row g-3" id="gridView"></div>

    <div class="card d-none" id="listView">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Project</th>
                        <th>Status</th>
                        <th style="min-width: 160px">Progress</th>
                        <th>Tasks</th>
                        <th>Team</th>
                        <th>Due date</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody id="listBody"></tbody>
            </table>
        </div>
    </div>

    <div
        class="modal fade"
        ref="modalProjectRef"
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
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <form @submit.prevent="submitProjectForm">
                    <div class="modal-body">
                        <div class="row g-3">
                            <div class="col-12">
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
                                    rows="3"
                                    placeholder="What is this project about?"
                                    v-model="projectForm.project_desc"
                                ></textarea>
                            </div>
                            <div class="col-md-4">
                                <label for="projStatus" class="form-label"
                                    >Status</label
                                >
                                <select
                                    class="form-select"
                                    v-model="projectForm.status"
                                >
                                    <option class="planning">Planning</option>
                                    <option class="active">Active</option>
                                    <option class="hold">On hold</option>
                                    <option class="completed">Completed</option>
                                </select>
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
                            data-bs-dismiss="modal"
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
</template>
