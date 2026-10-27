<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
const form = useForm({
    email: "",
    password: "",
    remember: false,
});

const submit = () => {
    form.post(route("login"), {
        onFinish: () => form.reset("password"),
    });
};
</script>
<style>
body {
    background-color: #f4f6fb;
}
.login-card {
    max-width: 420px;
    width: 100%;
}
.brand-icon {
    width: 52px;
    height: 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    font-size: 1.6rem;
}
</style>
<template>
    <Head title="Login" />
    <main
        class="min-vh-100 d-flex align-items-center justify-content-center p-3"
    >
        <div class="login-card">
            <!-- Brand -->
            <div class="text-center mb-4">
                <div class="brand-icon bg-primary text-white rounded-3 mb-3">
                    <img src="Logo/PTMS-logo.png" alt="" />
                </div>
                <h1 class="h4 fw-bold mb-1">TaskFlow</h1>
                <p class="text-muted mb-0">
                    Project and Task Management System
                </p>
            </div>

            <!-- Login Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-body p-4">
                    <h2 class="h5 fw-semibold mb-1">Welcome back</h2>
                    <p class="text-muted small mb-4">
                        Sign in to continue to your dashboard.
                    </p>

                    <!-- Error alert (remove d-none to show) -->
                    <div
                        class="alert alert-danger d-none py-2 small"
                        role="alert"
                        v-if="Object.keys(form.errors).length"
                    >
                        These credentials do not match our records.
                    </div>

                    <form @submit.prevent="submit" novalidate>
                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label"
                                >Email address</label
                            >
                            <div class="input-group">
                                <span class="input-group-text bg-white"
                                    ><i class="fa-solid fa-user"></i
                                ></span>
                                <input
                                    type="email"
                                    class="form-control"
                                    v-model="form.email"
                                    :class="{ 'is-invalid': form.errors.email }"
                                    placeholder="you@example.com"
                                    autocomplete="email"
                                    required
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.email"
                                >
                                    {{ form.errors.email }}
                                </div>
                            </div>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label"
                                    >Password</label
                                >
                                <a href="#" class="small text-decoration-none"
                                    >Forgot password?</a
                                >
                            </div>
                            <div class="input-group">
                                <span class="input-group-text bg-white"
                                    ><i class="fa-solid fa-lock"></i
                                ></span>
                                <input
                                    type="password"
                                    class="form-control"
                                    v-model="form.password"
                                    :class="{
                                        'is-invalid': form.errors.password,
                                    }"
                                    placeholder="Enter your password"
                                    autocomplete="current-password"
                                    required
                                />
                                <div
                                    class="invalid-feedback"
                                    v-if="form.errors.password"
                                >
                                    {{ form.errors.password }}
                                </div>
                            </div>
                        </div>

                        <!-- Remember me -->
                        <div class="form-check mb-4">
                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="remember"
                                name="remember"
                            />
                            <label class="form-check-label small" for="remember"
                                >Remember me</label
                            >
                        </div>

                        <!-- Submit -->
                        <button
                            type="submit"
                            class="btn btn-primary w-100 py-2"
                        >
                            <i class="fa-solid fa-arrow-right"></i> Sign in
                        </button>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted small mt-4 mb-0">
                &copy; <span id="year"></span> TaskFlow. All rights reserved.
            </p>
        </div>
    </main>
</template>
