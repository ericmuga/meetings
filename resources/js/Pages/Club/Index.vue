<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
// import makeupCard from '@/Components/makeupCard.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Swal from 'sweetalert2'
 import gsap from 'gsap';

 import SearchBox from '@/Components/SearchBox.vue'
import Drop from '../../Components/Drop.vue';


const form2 = useForm({
                            name:'',
                            description:'',
                            area:'',

                            })

const props=defineProps({ clubs:Object,
                             model:String,
                             search:String,
                             baseURL:String,


                            })



const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Create New Club',
                                                    html:
                                                        '<input id="name" type="text"  placeholder="Name*" class="swal2-input" required>' +
                                                        '<input id="description" type="text"  placeholder="Description*" class="swal2-input" required>' +
                                                        '<input id="area" type="text"  placeholder="Location*" class="swal2-input" required>'
                                                        ,
                                                   focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form2.name=document.getElementById('name').value,
                                                                        form2.description=document.getElementById('description').value,
                                                                        form2.area=document.getElementById('area').value,


                                                                           form2.post(route('club.store'),{
                                                                                        preserveScroll: true,
                                                                                        onSuccess: () => Swal.fire(
                                                                                                                'Success!',
                                                                                                                'Club has been added.',
                                                                                                                'success')

                                                                             }
                                                                           )
                                                                    }
                                                    })


</script>

<template>
    <Head title="Clubs" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                makeups

            </h2>
        </template> -->
         <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                   <Toolbar>
                    <template #start>
                        <!-- <Link :href="route('makeup.create')"> -->
                          <Button label="New" icon="pi pi-plus" class="mr-2" @click="showForm"/>
                       <!-- <a :href="route('makeups.download')">
                          <Button label="Download" icon="pi pi-download" class="mr-2 p-button-secondary" />
                        </a> -->


                </template>

                    <template #end>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                             <SearchBox :model="`club.index`" />

                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <!-- <Button icon="pi pi-calendar" class="mr-2 p-button-success" /> -->
                        <!-- <Button icon="pi pi-times" class="p-button-danger" /> -->
                    </template>
                </Toolbar>

                    <div class="w-full text-center">
                            <div v-if="clubs.data.length===0">
                                No clubs were found
                            </div>

                            <div v-else>
                                <Pagination :links=clubs.links :prefix=model />
                            </div>

                             </div>
                             <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"

                                    >

                                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="clubs.data.length>0">
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            Name
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Description
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                           Geography
                                                        </th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                                                        v-for="club in clubs.data" :key=club.id
                                                      >
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{club.name}}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{club.description}}
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            {{club.area}}
                                                        </td>


                                                        <td class="flex px-6 py-4">
                                                            <div class="flex-col justify-center">
                                                                <Link :href="route('club.edit',club.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                                                <Drop :dropRoute="route('club.destroy',club.id)"/>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>




                                </transition>



                        <div class="w-full text-center">
                            <div v-if="clubs.data.length===0">
                                                         </div>
                            <div v-else>
                                <Pagination :links=clubs.links :prefix=model />
                            </div>
                        </div>




                </div>
            </div>
         </div>

    </BreezeAuthenticatedLayout>
</template>
