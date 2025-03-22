<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps({
    href: String,
    as: String,
});
</script>

<template>
    <div>
        <button v-if="as == 'button'" type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:bg-accent focus:text-accent-foreground transition duration-150 ease-in-out">
            <slot />
        </button>

        <Link v-else-if="as == 'a'" :href="href" class="block px-4 py-2 text-sm leading-5 text-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:bg-accent focus:text-accent-foreground transition duration-150 ease-in-out">
            <slot />
        </Link>

        <Link v-else :href="href" class="block px-4 py-2 text-sm leading-5 text-foreground hover:bg-accent hover:text-accent-foreground focus:outline-none focus:bg-accent focus:text-accent-foreground transition duration-150 ease-in-out">
            <slot />
        </Link>
    </div>
</template>
