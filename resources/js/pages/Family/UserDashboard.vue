<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import { Card, CardContent, CardDescription, CardFooter, CardHeader, CardTitle } from '@/Components/ui/card';
import Heading from '@/Components/Heading.vue';
import HeadingSmall from '@/Components/HeadingSmall.vue';

// Sample data for demonstration
const userWallet = ref({
  balance: '$45.25',
  pending_rewards: '$12.50'
});

const recentTransactions = ref([
  { id: 1, date: '2023-06-15', description: 'Allowance', amount: '$20.00', type: 'credit' },
  { id: 2, date: '2023-06-12', description: 'Savings Goal Contribution', amount: '$10.00', type: 'debit' },
  { id: 3, date: '2023-06-08', description: 'Task Reward', amount: '$5.50', type: 'credit' }
]);

const pendingTasks = ref([
  { id: 1, title: 'Clean bedroom', due_date: '2023-06-18', reward: '$5.00', status: 'pending', description: 'Make sure to vacuum and dust all surfaces.' },
  { id: 2, title: 'Homework completion', due_date: '2023-06-19', reward: '$7.50', status: 'pending', description: 'Complete all assigned math homework for the week.' },
  { id: 3, title: 'Help with groceries', due_date: '2023-06-21', reward: '$6.00', status: 'pending', description: 'Help bring in groceries from the car and put them away.' }
]);

const completedTasks = ref([
  { id: 1, title: 'Take out trash', completion_date: '2023-06-14', reward: '$2.50', status: 'completed' },
  { id: 2, title: 'Wash dishes', completion_date: '2023-06-10', reward: '$3.00', status: 'completed' }
]);

const savingsGoals = ref([
  { id: 1, title: 'New Bicycle', target: '$120.00', current: '$75.50', progress: 63, image: '/images/bicycle-placeholder.jpg', description: 'Mountain bike for weekend rides' }
]);
</script>

<template>
  <AppLayout title="My Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-foreground leading-tight">
        My Dashboard
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- User Wallet Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
          <Card class="bg-gradient-to-br from-primary/10 to-primary/5">
            <CardHeader>
              <CardTitle>My Wallet</CardTitle>
              <CardDescription>Current balance and pending rewards</CardDescription>
            </CardHeader>
            <CardContent>
              <div class="text-4xl font-bold mb-2 text-foreground">{{ userWallet.balance }}</div>
              <div class="text-sm text-muted-foreground">Available to spend or save</div>
            </CardContent>
            <CardFooter>
              <div class="text-sm text-muted-foreground">
                <span class="font-medium text-primary">{{ userWallet.pending_rewards }}</span> pending from unverified tasks
              </div>
            </CardFooter>
          </Card>

          <Card>
            <CardHeader>
              <CardTitle>Recent Transactions</CardTitle>
              <CardDescription>Your latest earnings and spending</CardDescription>
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
                View all transactions
              </div>
            </CardFooter>
          </Card>
        </div>

        <!-- Savings Goals -->
        <div class="mb-8">
          <HeadingSmall>My Savings Goals</HeadingSmall>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
            <Card v-for="goal in savingsGoals" :key="goal.id" class="relative overflow-hidden">
              <div class="absolute top-0 right-0 left-0 h-20 bg-gradient-to-r from-primary/20 to-primary/10"></div>
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
                  Add to Savings
                </button>
              </CardFooter>
            </Card>

            <Card class="border-dashed border-2 flex flex-col items-center justify-center">
              <CardContent class="flex flex-col items-center py-10">
                <div class="rounded-full w-12 h-12 bg-muted flex items-center justify-center mb-3">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="text-muted-foreground">
                    <path d="M12 5v14"></path>
                    <path d="M5 12h14"></path>
                  </svg>
                </div>
                <h3 class="text-lg font-medium">Create a New Savings Goal</h3>
                <p class="text-sm text-muted-foreground text-center mt-2">
                  Set targets and save for the things you want most
                </p>
              </CardContent>
            </Card>
          </div>
        </div>

        <!-- Tasks Section -->
        <div class="mb-8">
          <HeadingSmall>My Tasks</HeadingSmall>
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-4">
            <!-- Pending Tasks -->
            <Card v-for="task in pendingTasks" :key="task.id" class="bg-card">
              <CardHeader class="pb-3">
                <div class="flex justify-between items-start">
                  <CardTitle class="text-lg">{{ task.title }}</CardTitle>
                  <span class="px-2 py-1 bg-amber-100 dark:bg-amber-950/30 text-amber-800 dark:text-amber-400 rounded text-xs font-medium">Pending</span>
                </div>
                <CardDescription class="mt-1.5">Due by {{ task.due_date }}</CardDescription>
              </CardHeader>
              <CardContent class="pb-3">
                <p class="text-muted-foreground text-sm mb-4">{{ task.description }}</p>
                <div class="font-medium text-primary">Reward: {{ task.reward }}</div>
              </CardContent>
              <CardFooter class="flex justify-between">
                <button class="py-2 px-4 bg-primary text-primary-foreground text-sm rounded-md font-medium hover:bg-primary/90 transition">
                  Mark Complete
                </button>
                <button class="py-2 px-4 bg-muted text-muted-foreground text-sm rounded-md font-medium hover:bg-muted/90 transition">
                  Details
                </button>
              </CardFooter>
            </Card>
          </div>
        </div>

        <!-- Completed Tasks -->
        <div>
          <HeadingSmall>Recently Completed</HeadingSmall>
          <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            <Card v-for="task in completedTasks" :key="task.id" class="bg-muted/30">
              <CardHeader class="pb-2">
                <div class="flex justify-between items-start">
                  <CardTitle class="text-base">{{ task.title }}</CardTitle>
                  <span class="px-2 py-1 bg-green-100 dark:bg-green-950/30 text-green-800 dark:text-green-400 rounded text-xs font-medium">Completed</span>
                </div>
                <CardDescription class="text-xs">{{ task.completion_date }}</CardDescription>
              </CardHeader>
              <CardContent>
                <div class="text-sm font-medium text-primary">Earned: {{ task.reward }}</div>
              </CardContent>
            </Card>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template> 