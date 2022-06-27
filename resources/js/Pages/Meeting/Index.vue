<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MeetingCard from '@/Components/MeetingCard.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'

 import gsap from 'gsap';
import Swal from 'sweetalert2'

const form=useForm({
                    Start:'',
                    end:''
})



const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Select date range',
                                                    html:
                                                        '<input id="swal-input1" type="date" v-model="form.Start" placeholder="From" class="swal2-input">' +
                                                        '<input id="swal-input2" type="date" placeholder="To" v-model="form.end" class="swal2-input">',
                                                    focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form.Start=document.getElementById('swal-input1').value,
                                                                        form.end=document.getElementById('swal-input2').value
                                                                           form.post(route('zoom.meetings'))
                                                                    }
                                                    })




const props=defineProps({ meetings:Object,
                             search:String,



                            })

 const beforeEnter=(el)=>{
            //    console.log('set the initial state')
             el.style.opacity=0;
             el.style.transform='translateX(-40px)'
        }

        const enter =(el)=>{
            // console.log('starting to enter into the dom')
                gsap.to(el,{
                    opacity:1,
                    x:0,
                    duration:0.8,
                            // onComplete:done
            })
        }

</script>

<template>
    <Head title="Meetings" />

    <BreezeAuthenticatedLayout>
         <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                   <Toolbar>
                    <template #start>
                        <Link :href="route('meeting.create')">
                          <Button label="New" icon="pi pi-plus" class="mr-2" />
                        </Link>

                        <Button label="Zoom" icon="pi pi-cloud-download" class="p-button-success" @click="showForm" />
                        <!-- <i class="mr-2 pi pi-bars p-toolbar-separator" /> -->
                        <!-- <SplitButton label="Save" icon="pi pi-check" :model="items" class="p-button-warning"></SplitButton> -->
                    </template>

                    <template #end>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText type="text" v-model="value3" placeholder="Search" />
                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <Button icon="pi pi-calendar" class="mr-2 p-button-success" />
                        <Button icon="pi pi-times" class="p-button-danger" />
                    </template>
                </Toolbar>

                    <div class="w-full text-center">
                            <div v-if="meetings.data.length===0" class="p-3 m-3">
                                No meetings were found
                            </div>

                            <div v-else class="p-3 mb-10">
                                <Pagination :links=meetings.links />
                            </div>

                        </div>
                    <div class="grid justify-center gap-2 m-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4">

                             <div class="col-span-1" v-for="meeting in meetings.data" :key="meeting.id">
                                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                                                                               <MeetingCard :meeting=meeting />
                                </transition>
                            </div>
                   </div>

                        <div class="w-full mt-3 text-center">
                            <div v-if="meetings.data.length===0">
                                No meetings were found
                            </div>
                            <div v-else>
                                <Pagination :links=meetings.links :prefix=model />
                            </div>
                        </div>




                </div>
            </div>
         </div>

    </BreezeAuthenticatedLayout>
</template>
