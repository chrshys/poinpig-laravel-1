<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Heading from '@/Components/Heading.vue';
import HeadingSmall from '@/Components/HeadingSmall.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

// Sample data for demonstration
const members = ref([
  { id: 1, name: 'John Doe', role: 'Parent', wallet: '$120.50', tasks_completed: 15, tasks_pending: 2 },
  { id: 2, name: 'Jane Doe', role: 'Parent', wallet: '$85.75', tasks_completed: 12, tasks_pending: 1 },
  { id: 3, name: 'Mike Smith', role: 'Child', wallet: '$45.25', tasks_completed: 8, tasks_pending: 3 },
  { id: 4, name: 'Sarah Smith', role: 'Child', wallet: '$32.00', tasks_completed: 6, tasks_pending: 4 }
]);

const recentTransactions = ref([
  { id: 1, date: '2023-06-15', description: 'Allowance', amount: '$20.00', type: 'credit', member: 'Mike Smith' },
  { id: 2, date: '2023-06-14', description: 'Task Reward', amount: '$5.50', type: 'credit', member: 'Sarah Smith' },
  { id: 3, date: '2023-06-12', description: 'Savings Goal Contribution', amount: '$10.00', type: 'debit', member: 'Mike Smith' },
  { id: 4, date: '2023-06-10', description: 'Task Reward', amount: '$7.25', type: 'credit', member: 'Sarah Smith' },
  { id: 5, date: '2023-06-08', description: 'Allowance', amount: '$20.00', type: 'credit', member: 'Mike Smith' }
]);

const pendingTasks = ref([
  { id: 1, title: 'Clean bedroom', assigned_to: 'Mike Smith', due_date: '2023-06-18', reward: '$5.00', status: 'pending' },
  { id: 2, title: 'Take out trash', assigned_to: 'Sarah Smith', due_date: '2023-06-17', reward: '$2.50', status: 'pending' },
  { id: 3, title: 'Homework completion', assigned_to: 'Mike Smith', due_date: '2023-06-19', reward: '$7.50', status: 'pending' },
  { id: 4, title: 'Help with dinner', assigned_to: 'Sarah Smith', due_date: '2023-06-20', reward: '$4.00', status: 'pending' }
]);

const savingsGoals = ref([
  { id: 1, title: 'New Bicycle', target: '$120.00', current: '$75.50', member: 'Mike Smith', progress: 63 },
  { id: 2, title: 'Video Game', target: '$60.00', current: '$45.75', member: 'Sarah Smith', progress: 76 }
]);
</script>

<template>
  <AppLayout title="Family Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-foreground leading-tight">
        Family Dashboard (Owner View)
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Family Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Family Members</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">{{ members.length }}</p>
            </CardContent>
          </Card>
          
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Total Wallet Balance</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">$283.50</p>
            </CardContent>
          </Card>
          
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Tasks Pending</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">{{ pendingTasks.length }}</p>
            </CardContent>
          </Card>
          
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Savings Goals</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">{{ savingsGoals.length }}</p>
            </CardContent>
          </Card>
        </div>

        <!-- Family Members Table -->
        <div class="mb-8 bg-card rounded-lg shadow-sm border border-border">
          <div class="px-4 py-5 sm:px-6 border-b border-border">
            <HeadingSmall>Family Members</HeadingSmall>
            <p class="mt-1 text-sm text-muted-foreground">Manage all members of your family group.</p>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
              <thead class="bg-muted/50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Name</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Role</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Wallet Balance</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Tasks Completed</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Tasks Pending</th>
                </tr>
              </thead>
              <tbody class="bg-card divide-y divide-border">
                <tr v-for="member in members" :key="member.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">{{ member.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ member.role }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ member.wallet }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ member.tasks_completed }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ member.tasks_pending }}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>

        <!-- Two Column Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
          <!-- Recent Transactions -->
          <div class="bg-card rounded-lg shadow-sm border border-border">
            <div class="px-4 py-5 sm:px-6 border-b border-border">
              <HeadingSmall>Recent Transactions</HeadingSmall>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-border">
                <thead class="bg-muted/50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Member</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Amount</th>
                  </tr>
                </thead>
                <tbody class="bg-card divide-y divide-border">
                  <tr v-for="transaction in recentTransactions" :key="transaction.id">
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.date }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.description }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.member }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm" :class="transaction.type === 'credit' ? 'text-green-600 dark:text-green-400' : 'text-red-600 dark:text-red-400'">
                      {{ transaction.type === 'credit' ? '+' : '-' }} {{ transaction.amount }}
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <!-- Pending Tasks -->
          <div class="bg-card rounded-lg shadow-sm border border-border">
            <div class="px-4 py-5 sm:px-6 border-b border-border">
              <HeadingSmall>Pending Tasks</HeadingSmall>
            </div>
            <div class="overflow-x-auto">
              <table class="min-w-full divide-y divide-border">
                <thead class="bg-muted/50">
                  <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Task</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Assigned To</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Due Date</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Reward</th>
                  </tr>
                </thead>
                <tbody class="bg-card divide-y divide-border">
                  <tr v-for="task in pendingTasks" :key="task.id">
                    <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-foreground">{{ task.title }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ task.assigned_to }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ task.due_date }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-green-600 dark:text-green-400">{{ task.reward }}</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <!-- Savings Goals -->
        <div class="mt-8 bg-card rounded-lg shadow-sm border border-border">
          <div class="px-4 py-5 sm:px-6 border-b border-border">
            <HeadingSmall>Savings Goals</HeadingSmall>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
              <thead class="bg-muted/50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Goal</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Member</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Target</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Current</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Progress</th>
                </tr>
              </thead>
              <tbody class="bg-card divide-y divide-border">
                <tr v-for="goal in savingsGoals" :key="goal.id">
                  <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-foreground">{{ goal.title }}</td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ goal.member }}</td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ goal.target }}</td>
                  <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ goal.current }}</td>
                  <td class="px-6 py-3 whitespace-nowrap">
                    <div class="w-full bg-muted rounded-full h-2">
                      <div class="bg-primary h-2 rounded-full" :style="{ width: goal.progress + '%' }"></div>
                    </div>
                    <span class="text-xs text-muted-foreground mt-1 inline-block">{{ goal.progress }}%</span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
