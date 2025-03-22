<script setup lang="ts">
import { ref } from 'vue';
import { Head } from '@inertiajs/vue3';
import AppLayout from '@/Layouts/AppLayout.vue';
import Heading from '@/Components/Heading.vue';
import HeadingSmall from '@/Components/HeadingSmall.vue';
import { Card, CardContent, CardHeader, CardTitle } from '@/Components/ui/card';

// Sample data for demonstration
const students = ref([
  { id: 1, name: 'Alex Johnson', grade: '5th', wallet: '$35.75', tasks_completed: 12, tasks_pending: 2 },
  { id: 2, name: 'Emma Garcia', grade: '5th', wallet: '$42.50', tasks_completed: 15, tasks_pending: 1 },
  { id: 3, name: 'Noah Wilson', grade: '5th', wallet: '$28.25', tasks_completed: 9, tasks_pending: 3 },
  { id: 4, name: 'Olivia Brown', grade: '5th', wallet: '$31.00', tasks_completed: 10, tasks_pending: 2 },
  { id: 5, name: 'William Davis', grade: '5th', wallet: '$22.75', tasks_completed: 7, tasks_pending: 4 }
]);

const recentTransactions = ref([
  { id: 1, date: '2023-06-15', description: 'Performance Reward', amount: '$5.00', type: 'credit', student: 'Emma Garcia' },
  { id: 2, date: '2023-06-14', description: 'Assignment Completion', amount: '$3.50', type: 'credit', student: 'Alex Johnson' },
  { id: 3, date: '2023-06-12', description: 'Educational Program', amount: '$2.50', type: 'debit', student: 'Noah Wilson' },
  { id: 4, date: '2023-06-10', description: 'Group Project', amount: '$4.25', type: 'credit', student: 'Olivia Brown' },
  { id: 5, date: '2023-06-08', description: 'Weekly Bonus', amount: '$3.00', type: 'credit', student: 'William Davis' }
]);

const pendingTasks = ref([
  { id: 1, title: 'Math Worksheet', assigned_to: 'All Students', due_date: '2023-06-18', reward: '$3.00', status: 'pending' },
  { id: 2, title: 'Reading Journal', assigned_to: 'Emma Garcia, Alex Johnson', due_date: '2023-06-17', reward: '$2.50', status: 'pending' },
  { id: 3, title: 'Science Project', assigned_to: 'All Students', due_date: '2023-06-19', reward: '$5.00', status: 'pending' },
  { id: 4, title: 'History Essay', assigned_to: 'Noah Wilson, William Davis', due_date: '2023-06-20', reward: '$4.00', status: 'pending' }
]);

const educationalGoals = ref([
  { id: 1, title: 'Class Library Books', target: '$150.00', current: '$95.50', progress: 64 },
  { id: 2, title: 'Field Trip Fund', target: '$300.00', current: '$125.75', progress: 42 }
]);
</script>

<template>
  <AppLayout title="Classroom Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-foreground leading-tight">
        Classroom Dashboard (Teacher View)
      </h2>
    </template>

    <div class="py-6">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Classroom Summary -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Students</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">{{ students.length }}</p>
            </CardContent>
          </Card>
          
          <Card>
            <CardHeader class="pb-2">
              <CardTitle class="text-sm font-medium">Total Class Wallet</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">$160.25</p>
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
              <CardTitle class="text-sm font-medium">Educational Goals</CardTitle>
            </CardHeader>
            <CardContent>
              <p class="text-2xl font-bold">{{ educationalGoals.length }}</p>
            </CardContent>
          </Card>
        </div>

        <!-- Students Table -->
        <div class="mb-8 bg-card rounded-lg shadow-sm border border-border">
          <div class="px-4 py-5 sm:px-6 border-b border-border">
            <HeadingSmall>Students</HeadingSmall>
            <p class="mt-1 text-sm text-muted-foreground">Manage all students in your classroom.</p>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
              <thead class="bg-muted/50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Name</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Grade</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Wallet Balance</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Tasks Completed</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Tasks Pending</th>
                </tr>
              </thead>
              <tbody class="bg-card divide-y divide-border">
                <tr v-for="student in students" :key="student.id">
                  <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-foreground">{{ student.name }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ student.grade }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ student.wallet }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ student.tasks_completed }}</td>
                  <td class="px-6 py-4 whitespace-nowrap text-sm text-muted-foreground">{{ student.tasks_pending }}</td>
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
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Student</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Amount</th>
                  </tr>
                </thead>
                <tbody class="bg-card divide-y divide-border">
                  <tr v-for="transaction in recentTransactions" :key="transaction.id">
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.date }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.description }}</td>
                    <td class="px-6 py-3 whitespace-nowrap text-sm text-muted-foreground">{{ transaction.student }}</td>
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

        <!-- Educational Goals -->
        <div class="mt-8 bg-card rounded-lg shadow-sm border border-border">
          <div class="px-4 py-5 sm:px-6 border-b border-border">
            <HeadingSmall>Educational Goals</HeadingSmall>
          </div>
          <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-border">
              <thead class="bg-muted/50">
                <tr>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Goal</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Target</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Current</th>
                  <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-muted-foreground uppercase tracking-wider">Progress</th>
                </tr>
              </thead>
              <tbody class="bg-card divide-y divide-border">
                <tr v-for="goal in educationalGoals" :key="goal.id">
                  <td class="px-6 py-3 whitespace-nowrap text-sm font-medium text-foreground">{{ goal.title }}</td>
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
