<script setup>
import ActionMessage from '@/Components/ActionMessage.vue';
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

const props = defineProps({
    team: Object,
    permissions: Object,
});

const form = useForm({
    name: props.team.name,
    team_type: props.team.team_type || 'family',
    description: props.team.description || '',
    educational_grade: props.team.educational_grade || '',
});

const updateTeamName = () => {
    form.put(route('teams.update', props.team), {
        errorBag: 'updateTeamName',
        preserveScroll: true,
    });
};
</script>

<template>
    <FormSection @submitted="updateTeamName">
        <template #title> Team Information </template>

        <template #description> The team's basic information. </template>

        <template #form>
            <!-- Team Owner Information -->
            <div class="col-span-6">
                <InputLabel value="Team Owner" />

                <div class="mt-2 flex items-center">
                    <img class="size-12 rounded-full object-cover" :src="team.owner.profile_photo_url" :alt="team.owner.name" />

                    <div class="ms-4 leading-tight">
                        <div class="text-gray-900 dark:text-white">{{ team.owner.name }}</div>
                        <div class="text-sm text-gray-700 dark:text-gray-300">
                            {{ team.owner.email }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Name -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="name" value="Team Name" />

                <TextInput id="name" v-model="form.name" type="text" class="mt-1 block w-full" :disabled="!permissions.canUpdateTeam" />

                <InputError :message="form.errors.name" class="mt-2" />
            </div>

            <!-- Team Type -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel value="Team Type" />
                <RadioGroup v-model="form.team_type" class="mt-2 flex flex-col space-y-2" :disabled="!permissions.canUpdateTeam">
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

            <!-- Description -->
            <div class="col-span-6 sm:col-span-4">
                <InputLabel for="description" value="Description" />
                <Textarea id="description" v-model="form.description" class="mt-1 block w-full" rows="3" :disabled="!permissions.canUpdateTeam" />
                <InputError :message="form.errors.description" class="mt-2" />
            </div>

            <!-- Educational Grade (for classroom team type) -->
            <div v-if="form.team_type === 'classroom'" class="col-span-6 sm:col-span-4">
                <InputLabel for="educational_grade" value="Grade Level" />
                <TextInput
                    id="educational_grade"
                    v-model="form.educational_grade"
                    type="text"
                    class="mt-1 block w-full"
                    :disabled="!permissions.canUpdateTeam"
                />
                <InputError :message="form.errors.educational_grade" class="mt-2" />
            </div>
        </template>

        <template v-if="permissions.canUpdateTeam" #actions>
            <ActionMessage :on="form.recentlySuccessful" class="me-3"> Saved. </ActionMessage>

            <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing"> Save </PrimaryButton>
        </template>
    </FormSection>
</template>
