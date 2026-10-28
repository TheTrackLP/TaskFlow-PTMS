<script setup>
import Navbar from "@/Components/Navbar.vue";
import Sidebar from "@/Components/Sidebar.vue";
import { ref } from "vue";

const sidebarOpen = ref(false);
const collapsed = ref(false);
</script>

<template>
    <body>
        <aside class="sidebar" :class="{ show: sidebarOpen, collapsed }">
            <Sidebar @navigate="sidebarOpen = false" />
        </aside>
        <div
            class="backdrop"
            :class="{ show: sidebarOpen }"
            @click="sidebarOpen = false"
        ></div>
        <!-- ============ MAIN ============ -->
        <div class="main">
            <Navbar @toggle-sidebar="collapsed = !collapsed" />
            <main class="p-3 p-lg-4">
                <slot />
            </main>
        </div>
    </body>
</template>
