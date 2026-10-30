<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
</script>

<style>
img {
    display: block;
    width: 45px;
    height: 45px;
    object-fit: contain;
    flex-shrink: 0;
    margin: 0;
    border-radius: 0;
}
</style>

<template>
    <div class="brand">
        <span class="brand-icon">
            <img src="/logo/PTMS-logo.png" alt="" />
        </span>
        <span class="brand-name fw-semibold fs-5">TaskFlow</span>
    </div>
    <nav class="sidebar-nav">
        <div class="nav-group">
            <div class="nav-heading">Main</div>
            <a
                href="#"
                class="nav-item-link active"
                data-view="dashboard"
                data-title="Dashboard"
                data-bs-title="Dashboard"
                aria-label="Dashboard"
                ><i class="fa-solid fa-gauge"></i
                ><span class="label">Dashboard</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="tasks"
                data-mine="1"
                data-title="My Tasks"
                data-bs-title="My Tasks"
                aria-label="My Tasks"
                ><i class="fa-solid fa-user-check"></i
                ><span class="label">My Tasks</span></a
            >
            <Link
                :href="route('tasks.dash')"
                class="nav-item-link"
                aria-label="All Tasks"
                ><i class="fa-solid fa-list-check"></i
                ><span class="label">All Tasks</span></Link
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Calendar"
                data-bs-title="Calendar"
                aria-label="Calendar"
                ><i class="fa-solid fa-calendar"></i
                ><span class="label">Calendar</span></a
            >
        </div>
        <div class="nav-group">
            <div class="nav-heading">Workspace</div>
            <Link
                :href="route('project.dash')"
                class="nav-item-link"
                aria-label="Projects"
                ><i class="fa-solid fa-folder-tree"></i
                ><span class="label">Projects</span></Link
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Team Members"
                data-bs-title="Team Members"
                aria-label="Team Members"
                ><i class="fa-solid fa-people-group"></i
                ><span class="label">Team Members</span></a
            >
        </div>
        <div class="nav-group">
            <div class="nav-heading">Management</div>
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Reports"
                data-bs-title="Reports"
                aria-label="Reports"
                ><i class="fa-solid fa-chart-simple"></i
                ><span class="label">Reports</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Activity Logs"
                data-bs-title="Activity Logs"
                aria-label="Activity Logs"
                ><i class="fa-solid fa-clock-rotate-left"></i
                ><span class="label">Activity Logs</span></a
            >
            <Link
                :href="route('users.list')"
                class="nav-item-link"
                aria-label="Users"
                ><i class="fa-solid fa-user-gear"></i
                ><span class="label">Users</span></Link
            >
        </div>
    </nav>
</template>
