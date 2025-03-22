<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-foreground leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-card text-card-foreground overflow-hidden shadow-xl sm:rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Welcome to CoinPig</h2>
                    
                    <div v-if="$page.props.auth.user && $page.props.auth.user.current_team">
                        <div class="bg-muted text-muted-foreground p-4 rounded-lg mb-6">
                            <h3 class="font-medium text-lg mb-2">Current Team: {{ $page.props.auth.user.current_team.name }}</h3>
                            <p class="mb-3">Team Type: <span class="capitalize">{{ $page.props.auth.user.current_team.team_type || 'Not set' }}</span></p>
                            
                            <template v-if="$page.props.auth.user.current_team.team_type === 'family'">
                                <div class="mt-4">
                                    <Link :href="route('family.dashboard')" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-primary-foreground uppercase tracking-widest hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
                                        Go to Family Dashboard
                                    </Link>
                                </div>
                            </template>
                            
                            <template v-else-if="$page.props.auth.user.current_team.team_type === 'classroom'">
                                <div class="mt-4">
                                    <Link :href="route('classroom.dashboard')" class="inline-flex items-center px-4 py-2 bg-primary border border-transparent rounded-md font-semibold text-xs text-primary-foreground uppercase tracking-widest hover:bg-primary/90 focus:outline-none focus:ring-2 focus:ring-ring focus:ring-offset-2 transition ease-in-out duration-150">
                                        Go to Classroom Dashboard
                                    </Link>
                                </div>
                            </template>
                            
                            <template v-else>
                                <div class="mt-4 text-amber-500">
                                    <p>Your team doesn't have a type set. Please update your team settings.</p>
                                </div>
                            </template>
                        </div>
                    </div>
                    
                    <div v-else class="text-muted-foreground">
                        <p>Please create or join a team to get started.</p>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
