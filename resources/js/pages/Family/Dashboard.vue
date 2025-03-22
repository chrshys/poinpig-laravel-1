<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Family Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-foreground">Family Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-card p-6 shadow-xl sm:rounded-lg text-card-foreground">
                    <h2 class="text-lg font-medium text-foreground">Welcome to your Family Dashboard</h2>
                    <p class="mt-2 text-muted-foreground">Manage your family's tasks, goals, and financial education in one place.</p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
