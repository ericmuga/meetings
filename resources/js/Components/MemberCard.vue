<template>
    <div>


            <div class="w-full max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">
            <div class="flex justify-end px-4 pt-4">

            </div>
            <div class="flex flex-col items-center pb-5">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src=member.gravatar alt="Bonnie image">
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{member.name}}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{member.field}}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{member.member_no}}</span>
                <div class="flex mt-4 space-x-3 lg:mt-6">
                       <Link
                          :href="route('member.show',member.id)"
                       >
                            <Button icon="pi pi-user" class="p-button-rounded p-button-info" />
                       </Link>

                            <!-- <Button icon="pi pi-times" class="justify-end p-button-rounded p-button-danger"
                                    @click="dropMember(member.id)"
                            /> -->
                        <Drop :dropRoute="route('member.destroy',member.id)" />


            </div>
            </div>
            </div>


    </div>
</template>

<script setup>
import { Inertia } from '@inertiajs/inertia';
import { useForm } from '@inertiajs/inertia-vue3'
import Drop from '@/Components/Drop.vue'

import Swal from 'sweetalert2'
const props= defineProps({
   member:Object,

});



</script>
