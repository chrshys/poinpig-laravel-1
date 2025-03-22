<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Classroom Dashboard">
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-foreground">Classroom Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-card p-6 shadow-xl sm:rounded-lg text-card-foreground">
                    <h2 class="text-lg font-medium text-foreground">Welcome to your Classroom Dashboard</h2>
                    <p class="mt-2 text-muted-foreground">
                        Manage your classroom's educational finances, student tasks, and learning goals.
                    </p>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
