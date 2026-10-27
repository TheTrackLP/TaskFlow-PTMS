<script>
import AdminLayout from "@/Layout/AdminLayout.vue";

export default {
    layout: AdminLayout,
};
</script>

<template>
    <div>
        <!-- ===== Dashboard view ===== -->
        <section id="view-dashboard" class="view">
            <div class="row g-3 mb-3" id="stats"></div>
            <div class="row g-3 mb-3">
                <div class="col-xl-8">
                    <div class="card h-100">
                        <div
                            class="card-header d-flex justify-content-between align-items-center py-3"
                        >
                            <h2 class="h6 mb-0">Recent Tasks</h2>
                            <button
                                class="btn btn-sm btn-outline-primary"
                                data-goto="tasks"
                            >
                                View all tasks
                            </button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>Task</th>
                                        <th>Project</th>
                                        <th>Priority</th>
                                        <th>Status</th>
                                        <th>Due</th>
                                    </tr>
                                </thead>
                                <tbody id="recentTasks"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card h-100">
                        <div class="card-header py-3">
                            <h2 class="h6 mb-0">Upcoming Deadlines</h2>
                        </div>
                        <ul
                            class="list-group list-group-flush"
                            id="deadlines"
                        ></ul>
                    </div>
                </div>
            </div>
            <div class="row g-3">
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header py-3">
                            <h2 class="h6 mb-0">Project Progress</h2>
                        </div>
                        <div class="card-body" id="projectProgress"></div>
                    </div>
                </div>
                <div class="col-md-6 col-xl-4">
                    <div class="card h-100">
                        <div class="card-header py-3">
                            <h2 class="h6 mb-0">Task Completion Summary</h2>
                        </div>
                        <div class="card-body" id="completion"></div>
                    </div>
                </div>
                <div class="col-xl-4">
                    <div class="card h-100">
                        <div class="card-header py-3">
                            <h2 class="h6 mb-0">Recent Activity</h2>
                        </div>
                        <ul
                            class="list-group list-group-flush"
                            id="activity"
                        ></ul>
                    </div>
                </div>
            </div>
        </section>

        <!-- ===== Task listing view ===== -->
        <section id="view-tasks" class="view d-none">
            <div class="card">
                <div class="card-body border-bottom">
                    <div class="row g-2 align-items-center">
                        <div class="col-12 col-lg">
                            <div class="input-group">
                                <span class="input-group-text bg-white"
                                    ><i class="bi bi-search"></i
                                ></span>
                                <input
                                    type="search"
                                    id="fSearch"
                                    class="form-control"
                                    placeholder="Search by title, project or assignee"
                                />
                            </div>
                        </div>
                        <div class="col-6 col-md-4 col-lg-auto">
                            <select
                                id="fStatus"
                                class="form-select"
                                aria-label="Filter by status"
                            >
                                <option value="">All statuses</option>
                                <option>To Do</option>
                                <option>In Progress</option>
                                <option>Completed</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-4 col-lg-auto">
                            <select
                                id="fPriority"
                                class="form-select"
                                aria-label="Filter by priority"
                            >
                                <option value="">All priorities</option>
                                <option>High</option>
                                <option>Medium</option>
                                <option>Low</option>
                            </select>
                        </div>
                        <div class="col-12 col-md-4 col-lg-auto">
                            <select
                                id="fProject"
                                class="form-select"
                                aria-label="Filter by project"
                            >
                                <option value="">All projects</option>
                            </select>
                        </div>
                        <div class="col-12 col-lg-auto">
                            <button
                                class="btn btn-primary w-100"
                                id="addTaskBtn"
                            >
                                <i class="bi bi-plus-lg me-1"></i>Add Task
                            </button>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Task</th>
                                <th>Project</th>
                                <th>Priority</th>
                                <th>Status</th>
                                <th>Due date</th>
                                <th>Assignee</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="taskRows"></tbody>
                    </table>
                </div>
                <div
                    class="card-footer bg-white small text-body-secondary"
                    id="taskCount"
                ></div>
            </div>
        </section>

        <!-- ===== Placeholder view for other pages ===== -->
        <section id="view-placeholder" class="view d-none">
            <div class="card">
                <div class="card-body text-center py-5">
                    <i class="bi bi-tools fs-1 text-body-secondary"></i>
                    <h2 class="h5 mt-3" id="phTitle">Page</h2>
                    <p class="text-body-secondary mb-0">
                        This page isn't built yet. Add its content here.
                    </p>
                </div>
            </div>
        </section>
    </div>
</template>
