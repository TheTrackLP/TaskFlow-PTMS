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
            <img src="Logo/PTMS-logo.png" alt="" />
        </span>
        <span class="brand-name fw-semibold fs-5">PTMS</span>
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
                ><i class="bi bi-speedometer2"></i
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
                ><i class="bi bi-person-check"></i
                ><span class="label">My Tasks</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="tasks"
                data-title="All Tasks"
                data-bs-title="All Tasks"
                aria-label="All Tasks"
                ><i class="bi bi-list-task"></i
                ><span class="label">All Tasks</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Calendar"
                data-bs-title="Calendar"
                aria-label="Calendar"
                ><i class="bi bi-calendar3"></i
                ><span class="label">Calendar</span></a
            >
        </div>
        <div class="nav-group">
            <div class="nav-heading">Workspace</div>
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Projects"
                data-bs-title="Projects"
                aria-label="Projects"
                ><i class="bi bi-folder2"></i
                ><span class="label">Projects</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Team Members"
                data-bs-title="Team Members"
                aria-label="Team Members"
                ><i class="bi bi-people"></i
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
                ><i class="bi bi-bar-chart-line"></i
                ><span class="label">Reports</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Activity Logs"
                data-bs-title="Activity Logs"
                aria-label="Activity Logs"
                ><i class="bi bi-clock-history"></i
                ><span class="label">Activity Logs</span></a
            >
            <a
                href="#"
                class="nav-item-link"
                data-view="placeholder"
                data-title="Settings"
                data-bs-title="Settings"
                aria-label="Settings"
                ><i class="bi bi-gear"></i
                ><span class="label">Settings</span></a
            >
        </div>
    </nav>
</template>
