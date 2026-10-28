<script setup>
import { computed, nextTick, ref } from "vue";
import { Modal } from "bootstrap";
import { Head, useForm } from "@inertiajs/vue3";

const modalFormRef = ref(null);
let modalInstanceForm = null;
const modalForm = () => {
    nextTick(() => {
        modalInstanceForm = new Modal(modalFormRef.value);
        modalInstanceForm.show();
    });
};

const openModalForm = () => {
    modalForm();
};

const closeFormModal = () => {
    modalInstanceForm?.hide();
    userForm.reset();
};

const userForm = useForm({
    name: "",
    username: "",
    email: "",
    job_title: "",
    emp_id: "",
    roles: "",
    status: "",
    password: "",
});

const submitUserForm = () => {
    userForm.post(route("users.store"), {
        onSuccess: () => {
            closeFormModal();
        },
    });
};

const changeStatus = (user) => {
    userForm.post(route("users.status", user.id));
};

const selectedText = ref("");
const selectedRoles = ref("");
const selectedStatus = ref("");

const filterUsers = computed(() => {
    const textQuery = selectedText.value.trim().toLowerCase();
    const rolesQuery = selectedRoles.value;
    const statusQuery = selectedStatus.value;

    return props.users.filter((user) => {
        const matchText =
            !textQuery ||
            user.name.toLowerCase().includes(textQuery) ||
            user.email.toLowerCase().includes(textQuery);

        const matchRoles = !rolesQuery || user.roles === rolesQuery;
        const matchStatus =
            !statusQuery || Number(user.status) === Number(statusQuery);

        return matchText && matchRoles && matchStatus;
    });
});

const clearFilters = () => {
    selectedText.value = "";
    selectedRoles.value = "";
    selectedStatus.value = "";
};

const props = defineProps({
    users: Array,
    totalUsers: Object,
    totalActive: Object,
    totalInactive: Object,
    totalAdmins: Object,
});
</script>
<style>
.table-responsive {
    overflow: auto;
    height: 550px;
}
.table-responsive,
th {
    top: 0;
    z-index: 0;
    position: sticky;
}
</style>
<script>
import AdminLayout from "@/Layout/AdminLayout.vue";
import { formattedDate } from "@/resuables";

export default {
    layout: AdminLayout,
};
</script>
<template>
    <Head title="Users" />
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-4"
    >
        <div>
            <h1 class="h4 fw-bold mb-1">Users</h1>
            <p class="text-muted mb-0">
                Create and manage accounts. Users can't sign themselves up.
            </p>
        </div>
        <button class="btn btn-primary" @click="openModalForm">
            <i class="fa-solid fa-user-plus"></i> Add user
        </button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-6 col-sm-6 col-xl-3">
            <div class="card border shadow-sm">
                <div
                    class="card-body d-flex justify-content-between align-items-start"
                >
                    <div>
                        <div class="text-secondary small">Total Users</div>
                        <div class="fs-5 text-muted">{{ totalUsers }}</div>
                    </div>
                    <div
                        class="rounded bg-primary-subtle text-primary px-3 py-2"
                    >
                        <i class="fa-solid fa-people-group"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-xl-3">
            <div class="card border shadow-sm">
                <div
                    class="card-body d-flex justify-content-between align-items-start"
                >
                    <div>
                        <div class="text-secondary small">Total Active</div>
                        <div class="fs-5 text-muted">{{ totalActive }}</div>
                    </div>
                    <div
                        class="rounded bg-success-subtle text-success px-3 py-2"
                    >
                        <i class="fa-solid fa-user-check"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-xl-3">
            <div class="card border shadow-sm">
                <div
                    class="card-body d-flex justify-content-between align-items-start"
                >
                    <div>
                        <div class="text-secondary small">Total Inactive</div>
                        <div class="fs-5 text-muted">{{ totalInactive }}</div>
                    </div>
                    <div class="rounded bg-danger-subtle text-danger px-3 py-2">
                        <i class="fa-solid fa-user-xmark"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-sm-6 col-xl-3">
            <div class="card border shadow-sm">
                <div
                    class="card-body d-flex justify-content-between align-items-start"
                >
                    <div>
                        <div class="text-secondary small">Total Admins</div>
                        <div class="fs-5 text-muted">{{ totalAdmins }}</div>
                    </div>
                    <div class="rounded bg-info-subtle text-info px-3 py-2">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="p-3 border-bottom">
        <div class="row g-2">
            <div class="col-md-6 col-xl-5">
                <div class="input-group">
                    <span class="input-group-text bg-white"
                        ><i class="fa-solid fa-magnifying-glass"></i
                    ></span>
                    <input
                        type="text"
                        class="form-control border-start-0"
                        placeholder="Search by name or email"
                        v-model="selectedText"
                    />
                </div>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <select
                    class="form-select"
                    id="filterRole"
                    aria-label="Filter by role"
                    v-model="selectedRoles"
                >
                    <option value="">All roles</option>
                    <option value="admin">Admin</option>
                    <option value="member">Member</option>
                </select>
            </div>
            <div class="col-6 col-md-3 col-xl-2">
                <select
                    class="form-select"
                    id="filterStatus"
                    aria-label="Filter by status"
                    v-model="selectedStatus"
                >
                    <option value="">All statuses</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
            <div
                class="col-xl-3 d-flex align-items-center justify-content-xl-end"
            >
                <button
                    class="btn btn-outline-secondary text-decoration-none"
                    @click="clearFilters"
                >
                    <i class="fa-solid fa-x"></i>Clear filters
                </button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-hover align-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fullname</th>
                    <th>Username</th>
                    <th>Job Title</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Created</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(user, index) in filterUsers" :key="index">
                    <td>{{ index + 1 }}</td>
                    <td>{{ user.name }}</td>
                    <td>{{ user.username }}</td>
                    <td>{{ user.job_title }}</td>
                    <td>{{ user.roles }}</td>
                    <td>
                        <span
                            class="badge text-bg-success"
                            v-if="user.status === 1"
                            >Active</span
                        >
                        <span
                            class="badge text-bg-danger"
                            v-else-if="user.status === 0"
                            >Inactive</span
                        >
                    </td>
                    <td>{{ formattedDate(user.created_at) }}</td>
                    <td class="text-end">
                        <button
                            type="button"
                            class="btn btn-success"
                            @click="changeStatus(user)"
                            v-if="user.status === 1"
                        >
                            <i class="fa-solid fa-square-plus"></i>
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="changeStatus(user)"
                            v-if="user.status === 0"
                        >
                            <i class="fa-solid fa-square-xmark"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div
        class="modal fade"
        ref="modalFormRef"
        tabindex="-1"
        data-bs-backdrop="static"
        data-bs-keyboard="false"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <form @submit.prevent="submitUserForm">
                    <div class="modal-header">
                        <h4 class="modal-title">User Form</h4>
                        <button
                            type="button"
                            class="btn-close"
                            @click="closeFormModal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="">Fullname</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="userForm.name"
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Username</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="userForm.username"
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Email</label>
                            <input
                                type="email"
                                class="form-control"
                                v-model="userForm.email"
                            />
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Job Title</label>
                            <input
                                type="text"
                                class="form-control"
                                v-model="userForm.job_title"
                            />
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="">Employee ID</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    v-model="userForm.emp_id"
                                />
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Role</label>
                                <select
                                    class="form-select"
                                    v-model="userForm.roles"
                                >
                                    <option value="" selected>
                                        Select Role
                                    </option>
                                    <option value="admin">Admin</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="">Status</label>
                                <select
                                    class="form-select"
                                    v-model="userForm.status"
                                >
                                    <option value="" selected>
                                        Select Status
                                    </option>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group mb-3">
                            <label for="">Password</label>
                            <input
                                type="password"
                                class="form-control"
                                v-model="userForm.password"
                            />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button
                            class="btn btn-secondary"
                            @click="closeFormModal"
                            type="button"
                        >
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-success">
                            Add User
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
