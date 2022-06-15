<template>
    <div>
        <div class="max-w-sm col-span-1 p-3 overflow-hidden rounded shadow-lg">
            <img class="w-full max-h-48" :src="`/images/reports/${report.name}.png`" alt="Member Gravatar" >
            <div class="flex justify-center px-6 py-4">
                <div class="mb-2 text-xl font-bold ">{{report.name}}</div>
            </div>
                <p class="text-base text-center text-gray-700">
                </p>
            <div class="px-6 pt-4 pb-2 text-center">
                <Link :href="route('report.show',report.id)">
                    <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">Explore</span>
                </Link>
            </div>
            </div>
    </div>
</template>

<script setup>
const props= defineProps({
                         report:Object,
})
</script>
