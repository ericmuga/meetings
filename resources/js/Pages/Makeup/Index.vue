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
                            date:'',
                            description:'',
                            detail:'',
                            category:'',
                            member_id:'',
                            })

const props=defineProps({ makeups:Object,
                             model:String,
                             search:String,
                             baseURL:String,
                             memberSelect:String,


                            })

const memberSelect=props.memberSelect



const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Create New makeup',
                                                    html:
                                                        '<input id="date" type="date"  placeholder="Date*" class="swal2-input">' +
                                                        '<select  id="category"  type="text"  placeholder="Category" class="swal2-input" required>' +
                                                            '<option  value="Committee Meeting">Committee Meeting</option>' +
                                                            '<option  value="Club Visit">Club Visit</option>' +
                                                            '<option  value="Projects">Projects</option>' +
                                                            '<option  value="Social">Social</option>' +
                                                            '<option  value="Training">Training</option>' +
                                                            '<option  value="Board Meeting">Board Meeting</option>' +
                                                            '<option  value="other">Other Activity</option>' +
                                                        '</select>'+
                                                        '<input id="description" type="text"  placeholder="Description*" class="swal2-input" required>' +
                                                        '<textarea id="detail" rows="50" cols="20" class="swal2-input" placeholder="Details ..*"></textarea>' +
                                                        '<br/><label>Member</label>'+
                                                        '<select  id="member_id"  type="text"  placeholder="Category" class="swal2-input" required>' +
                                                           memberSelect+
                                                        '</select>'
                                                        ,
                                                   focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form2.date=document.getElementById('date').value,
                                                                        form2.description=document.getElementById('description').value,
                                                                        form2.detail=document.getElementById('detail').value,
                                                                        form2.category=document.getElementById('category').value,
                                                                        form2.member_id=document.getElementById('member_id').value,

                                                                           form2.post(route('makeups.store'),{
                                                                                        preserveScroll: true,
                                                                                        onSuccess: () => Swal.fire(
                                                                                                                'Success!',
                                                                                                                'Makeup request has been added.',
                                                                                                                'success')

                                                                             }
                                                                           )
                                                                    }
                                                    })


</script>

<template>
    <Head title="Makeups" />

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
                             <SearchBox :model="`makeups.index`" />

                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <!-- <Button icon="pi pi-calendar" class="mr-2 p-button-success" /> -->
                        <!-- <Button icon="pi pi-times" class="p-button-danger" /> -->
                    </template>
                </Toolbar>

                    <div class="w-full text-center">
                            <div v-if="makeups.data.length===0">
                                No makeups were found
                            </div>

                            <div v-else>
                                <Pagination :links=makeups.links :prefix=model />
                            </div>

                             </div>
                    <!-- <div class="grid justify-center gap-2 m-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4"> -->

                                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"

                                    >

                                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="makeups.data.length>0">
                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            Date
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Description
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Requested By
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Approver
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Approval Date
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                                                        v-for="makeup in makeups.data" :key=makeup.id
                                                      >
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{makeup.makeup_date}}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{makeup.description}}
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            {{makeup.member}}
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            {{makeup.approver}}
                                                        </td>
                                                        <td class="px-6 py-4">
                                                            {{makeup.approval_date}}
                                                        </td>
                                                        <td class="flex px-6 py-4">
                                                            <div class="flex-col justify-center">
                                                                <Link :href="route('makeups.edit',makeup.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</Link>
                                                                <Drop :dropRoute="route('makeups.destroy',makeup.id)"/>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>

                                    <!-- <div class="col-span-1" v-for="makeup in makeups.data" :key="makeup.id">

                                        {{makeup}}
                                   </div> -->


                                </transition>

                     <!-- </div> -->

                        <div class="w-full text-center">
                            <div v-if="makeups.data.length===0">
                                                         </div>
                            <div v-else>
                                <Pagination :links=makeups.links :prefix=model />
                            </div>
                        </div>




                </div>
            </div>
         </div>

    </BreezeAuthenticatedLayout>
</template>
