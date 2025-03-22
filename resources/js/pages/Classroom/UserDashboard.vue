<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import Heading from '@/Components/Heading.vue';
import HeadingSmall from '@/Components/HeadingSmall.vue';

// Sample data for demonstration
const studentWallet = ref({
  balance: '$28.25',
  pending_rewards: '$8.50'
});

const recentTransactions = ref([
  { id: 1, date: '2023-06-15', description: 'Performance Reward', amount: '$5.00', type: 'credit' },
  { id: 2, date: '2023-06-12', description: 'Educational Program', amount: '$2.50', type: 'debit' },
  { id: 3, date: '2023-06-08', description: 'Assignment Completion', amount: '$3.50', type: 'credit' }
]);

const pendingAssignments = ref([
  { id: 1, title: 'Math Worksheet', due_date: '2023-06-18', reward: '$3.00', status: 'pending', description: 'Complete pages 25-27 in the workbook.' },
  { id: 2, title: 'Science Project', due_date: '2023-06-19', reward: '$5.00', status: 'pending', description: 'Create a model of the solar system.' },
  { id: 3, title: 'History Essay', due_date: '2023-06-21', reward: '$4.00', status: 'pending', description: 'Write a 500-word essay on ancient civilizations.' }
]);

const completedAssignments = ref([
  { id: 1, title: 'Reading Journal', completion_date: '2023-06-14', reward: '$2.50', status: 'completed' },
  { id: 2, title: 'Vocabulary Quiz', completion_date: '2023-06-10', reward: '$3.00', status: 'completed' }
]);

const classGoals = ref([
  { id: 1, title: 'Class Library Books', target: '$150.00', current: '$95.50', progress: 64, description: 'New books for our reading corner' },
  { id: 2, title: 'Field Trip Fund', target: '$300.00', current: '$125.75', progress: 42, description: 'Science museum field trip' }
]);

const badges = ref([
  { id: 1, title: 'Math Whiz', description: 'Completed 10 math assignments', icon: '🧮' },
  { id: 2, title: 'Bookworm', description: 'Read 5 books this month', icon: '📚' },
  { id: 3, title: 'Helper', description: 'Assisted classmates 3 times', icon: '🤝' }
]);
</script>

<template>
  <AppLayout title="Student Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-foreground leading-tight">
        My Student Dashboard
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Student Wallet Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <Card class="bg-gradient-to-br from-primary/10 to-primary/5">
            <CardHeader>
              <CardTitle>My Learning Wallet</CardTitle>
              <CardDescription>Current balance and pending rewards</CardDescription>
            </CardHeader>
            <CardContent>
              <div class="text-4xl font-bold mb-2 text-foreground">{{ studentWallet.balance }}</div>
              <div class="text-sm text-muted-foreground">Available for educational goals</div>
            </CardContent>
            <CardFooter>
              <div class="text-sm text-muted-foreground">
                <span class="font-medium text-primary">{{ studentWallet.pending_rewards }}</span> pending from ungraded assignments
              </div>
            </CardFooter>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Recent Activity</CardTitle>
              <CardDescription>Your latest educational transactions</CardDescription>
            </CardHeader>
            <CardContent>
              <div class="space-y-4">
                <div v-for="transaction in recentTransactions" :key="transaction.id" 
                     class="flex justify-between items-center border-b border-border pb-3 last:border-0">
                  <div>
                    <div class="font-medium">{{ transaction.description }}</div>
                    <div class="text-xs text-muted-foreground">{{ transaction.date }}</div>
                  </div>
                  <div :class="transaction.type === 'credit' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'" 
                       class="font-semibold">
                    {{ transaction.type === 'credit' ? '+' : '-' }} {{ transaction.amount }}
                  </div>
                </div>
              </div>
            </CardContent>
            <CardFooter>
              <div class="text-sm text-center text-primary w-full">
                View all activity
              </div>
            </CardFooter>
          </Card>
        </div>

        <!-- Badges Section -->
        <div class="mb-8">
          <HeadingSmall>My Achievement Badges</HeadingSmall>
          <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 mt-4">
            <Card v-for="badge in badges" :key="badge.id" class="border-0 bg-muted/30">
              <CardContent class="flex flex-col items-center text-center p-6">
                <div class="text-4xl mb-3">{{ badge.icon }}</div>
                <h3 class="font-medium mb-1">{{ badge.title }}</h3>
                <p class="text-xs text-muted-foreground">{{ badge.description }}</p>
              </CardContent>
            </Card>
            
            <Card class="border-dashed border-2 flex items-center justify-center bg-transparent">
              <CardContent class="flex flex-col items-center text-center p-6">
                <div class="rounded-full w-10 h-10 bg-muted flex items-center justify-center mb-2">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                  </svg>
                </div>
                <p class="text-xs text-muted-foreground">Complete more assignments to earn badges</p>
              </CardContent>
            </Card>
          </div>
        </div>

        <!-- Class Goals -->
        <div class="mb-8">
          <HeadingSmall>Class Goals</HeadingSmall>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <Card v-for="goal in classGoals" :key="goal.id" class="relative overflow-hidden">
              <div class="absolute top-0 right-0 left-0 h-12 bg-gradient-to-r from-primary/20 to-primary/10"></div>
              <CardHeader class="relative z-10">
                <CardTitle>{{ goal.title }}</CardTitle>
                <CardDescription>{{ goal.description }}</CardDescription>
              </CardHeader>
              <CardContent>
                <div class="flex justify-between mb-2">
                  <span class="text-sm text-muted-foreground">Progress</span>
                  <span class="text-sm font-medium">{{ goal.progress }}%</span>
                </div>
                <div class="w-full bg-muted rounded-full h-3 mb-4">
                  <div class="bg-primary h-3 rounded-full" :style="{ width: goal.progress + '%' }"></div>
                </div>
                <div class="flex justify-between text-sm">
                  <div>Current: <span class="font-medium">{{ goal.current }}</span></div>
                  <div>Target: <span class="font-medium">{{ goal.target }}</span></div>
                </div>
              </CardContent>
              <CardFooter>
                <button class="w-full py-2 px-4 bg-primary text-primary-foreground rounded-md hover:bg-primary/90 font-medium text-sm transition">
                  Contribute
                </button>
              </CardFooter>
            </Card>
          </div>
        </div>

        <!-- Assignments Section -->
        <div class="mb-8">
          <HeadingSmall>My Assignments</HeadingSmall>
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
            <!-- Pending Assignments -->
            <Card v-for="assignment in pendingAssignments" :key="assignment.id" class="bg-card">
              <CardHeader class="pb-3">
                <div class="flex justify-between items-start">
                  <CardTitle class="text-lg">{{ assignment.title }}</CardTitle>
                  <span class="px-2 py-1 bg-amber-100 dark:bg-amber-950/30 text-amber-800 dark:text-amber-400 rounded text-xs font-medium">Due Soon</span>
                </div>
                <CardDescription class="mt-1.5">Due by {{ assignment.due_date }}</CardDescription>
              </CardHeader>
              <CardContent class="pb-3">
                <p class="text-muted-foreground text-sm mb-4">{{ assignment.description }}</p>
                <div class="font-medium text-primary">Reward: {{ assignment.reward }}</div>
              </CardContent>
              <CardFooter class="flex justify-between">
                <button class="py-2 px-4 bg-primary text-primary-foreground text-sm rounded-md font-medium hover:bg-primary/90 transition">
                  Submit
                </button>
                <button class="py-2 px-4 bg-muted text-muted-foreground text-sm rounded-md font-medium hover:bg-muted/90 transition">
                  Details
                </button>
              </CardFooter>
            </Card>
          </div>
        </div>

        <!-- Completed Assignments -->
        <div>
          <HeadingSmall>Recently Completed</HeadingSmall>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <Card v-for="assignment in completedAssignments" :key="assignment.id" class="bg-muted/30">
              <CardHeader class="pb-2">
                <div class="flex justify-between items-start">
                  <CardTitle class="text-base">{{ assignment.title }}</CardTitle>
                  <span class="px-2 py-1 bg-green-100 dark:bg-green-950/30 text-green-800 dark:text-green-400 rounded text-xs font-medium">Completed</span>
                </div>
                <CardDescription class="text-xs">{{ assignment.completion_date }}</CardDescription>
              </CardHeader>
              <CardContent>
                <div class="text-sm font-medium text-primary">Earned: {{ assignment.reward }}</div>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template> 