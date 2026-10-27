<script setup lang="ts">
const emit = defineEmits(["toggleSidebar"]);
</script>
<template>
    <header
        class="topbar d-flex align-items-center gap-2 gap-md-3 px-3 px-lg-4"
    >
        <button
            class="btn btn-light border"
            type="button"
            aria-label="Toggle sidebar"
            @click.prevent="emit('toggleSidebar')"
        >
            <i class="fa-solid fa-bars"></i>
        </button>
        <h1 class="h5 mb-0 text-truncate" id="pageTitle">Dashboard</h1>
        <div class="ms-auto d-flex align-items-center gap-2 gap-md-3">
            <div class="input-group d-none d-md-flex" style="width: 260px">
                <span class="input-group-text bg-light border-end-0"
                    ><i class="bi bi-search"></i
                ></span>
                <input
                    type="search"
                    id="globalSearch"
                    class="form-control bg-light border-start-0"
                    placeholder="Search tasks..."
                />
            </div>
            <div class="dropdown">
                <button
                    class="btn btn-light border position-relative"
                    data-bs-toggle="dropdown"
                    data-bs-auto-close="outside"
                    aria-label="Notifications"
                >
                    <i class="bi bi-bell"></i
                    ><span class="badge rounded-pill bg-danger notif-badge"
                        >3</span
                    >
                </button>
                <div
                    class="dropdown-menu dropdown-menu-end dropdown-menu-notif p-0 shadow-sm"
                >
                    <div class="px-3 py-2 border-bottom fw-semibold">
                        Notifications
                    </div>
                    <a href="#" class="dropdown-item py-2 text-wrap small"
                        >Paolo Lim commented on
                        <strong>Map legacy tables to new schema</strong>
                        <div class="text-body-secondary">10 minutes ago</div></a
                    >
                    <a href="#" class="dropdown-item py-2 text-wrap small"
                        >You were assigned
                        <strong>Design homepage wireframes</strong>
                        <div class="text-body-secondary">1 hour ago</div></a
                    >
                    <a href="#" class="dropdown-item py-2 text-wrap small"
                        ><strong>Review payroll computation rules</strong>
                        is overdue
                        <div class="text-body-secondary">Yesterday</div></a
                    >
                </div>
            </div>
            <div class="dropdown">
                <button
                    class="btn p-0 border-0 d-flex align-items-center gap-2"
                    data-bs-toggle="dropdown"
                    aria-label="User menu"
                >
                    <span class="avatar">MS</span>
                    <span class="d-none d-md-block text-start lh-sm"
                        ><span class="d-block small fw-semibold"
                            >Maria Santos</span
                        ><span
                            class="d-block text-body-secondary"
                            style="font-size: 0.75rem"
                            >Project Manager</span
                        ></span
                    >
                    <i
                        class="bi bi-chevron-down small d-none d-md-block text-body-secondary"
                    ></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                    <li>
                        <a class="dropdown-item" href="#"
                            ><i class="bi bi-person me-2"></i>Profile</a
                        >
                    </li>
                    <li>
                        <a class="dropdown-item" href="#"
                            ><i class="bi bi-gear me-2"></i>Settings</a
                        >
                    </li>
                    <li><hr class="dropdown-divider" /></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#"
                            ><i class="bi bi-box-arrow-right me-2"></i>Logout</a
                        >
                    </li>
                </ul>
            </div>
        </div>
    </header>
</template>
