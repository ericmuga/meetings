<template>
    <div>


            <div class="w-full max-w-sm p-3 bg-white border border-gray-200 rounded-lg shadow-md dark:bg-gray-800 dark:border-gray-700">


            <div class="flex justify-center md:justify-end ">
                    <img class="object-cover w-10 h-10 border-2 border-indigo-500 rounded-full"
                    :src="`/images/${guest.icon}.png`"
                    >
                </div>

            <div class="flex flex-col items-center pb-5">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" :src=guest.gravatar alt="Guest Image">
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{guest.name}}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{guest.field}}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{guest.type}}</span>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{guest.member_no}}</span>
                <div class="flex mt-4 space-x-3 lg:mt-6">
                       <Link
                          :href="route('guest.show',guest.id)"
                       >
                         <Button icon="pi pi-user" class="p-button-rounded p-button-info" />
                       </Link>

                       <Link
                          :href="route('guest.edit',guest.id)"
                       >
                            <Button icon="pi pi-pencil" class="p-button-rounded p-button-secondary" />
                       </Link>

                            <!-- <Button icon="pi pi-times" class="justify-end p-button-rounded p-button-danger"
                                    @click="dropMember(guest.id)"
                            /> -->
                        <Drop :dropRoute="route('guest.destroy',guest.id)" />


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
import { onMounted,ref } from 'vue';
const props= defineProps({
   guest:Object,

});
const g=ref({});



// onMounted(()=>{
//     console.log(props.guest)
//     if (props.guest.id>0)
//     {
//      g.value=props.guest
//     }
//     else
//     g.value=props.guest.data
// })



</script>
