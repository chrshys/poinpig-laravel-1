<script setup>
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import RadioGroup from '@/Components/RadioGroup.vue';
import RadioGroupItem from '@/Components/RadioGroupItem.vue';
import Textarea from '@/Components/TextArea.vue';
import TextInput from '@/Components/TextInput.vue';
import { Label } from '@/Components/ui/label';
import { useForm } from '@inertiajs/vue3';

const form = useForm({
    name: '',
    team_type: 'family',
    description: '',
    educational_grade: '',
});

const createTeam = () => {
    form.post(route('teams.store'), {
        errorBag: 'createTeam',
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="createTeam">
        <template #title> Team Details </template>

        <template #description> Create a new team to collaborate with others on projects. </template>

        <template #form>
            <div class="col-span-6">
                <InputLabel value="Team Owner" />

                <div class="mt-2 flex items-center">
                    <img class="size-12 rounded-full object-cover" :src="$page.props.auth.user.profile_photo_url" :alt="$page.props.auth.user.name" />

                    <div class="ms-4 leading-tight">
                        <div class="text-gray-900 dark:text-white">{{ $page.props.auth.user.name }}</div>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            {{ $page.props.auth.user.email }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Team Name" />
                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" autofocus />
                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel value="Team Type" />
                <RadioGroup v-model="form.team_type" class="mt-2 flex flex-col space-y-2">
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="family" value="family" />
                        <Label for="family" class="cursor-pointer">Family (Parent-child structure for home use)</Label>
                    </div>
                    <div class="flex items-center space-x-2">
                        <RadioGroupItem id="classroom" value="classroom" />
                        <Label for="classroom" class="cursor-pointer">Classroom (Teacher-student structure for educational settings)</Label>
                    </div>
                </RadioGroup>
                <InputError :message="form.errors.team_type" class="mt-2" />
            </div>

            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Description" />
                <Textarea id="description" v-model="form.description" class="mt-1 block w-full" rows="3" />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <div v-if="form.team_type === 'classroom'" class="col-span-6 sm:col-span-4">
                <InputLabel for="educational_grade" value="Grade Level" />
                <TextInput id="educational_grade" v-model="form.educational_grade" type="text" class="mt-1 block w-full" />
                <InputError :message="form.errors.educational_grade" class="mt-2" />
            </div>
        </template>

        <template #actions>
            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Create </PrimaryButton>
        </template>
    </FormSection>
</template>
