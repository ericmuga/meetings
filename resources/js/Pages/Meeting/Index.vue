<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MeetingCard from '@/Components/MeetingCard.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import SearchBox from '@/Components/SearchBox.vue';

import gsap from 'gsap';
import Swal from 'sweetalert2'
import { onMounted } from '@vue/runtime-core';
import { watch,ref, computed, toRefs } from "@vue/runtime-core";
import  debounce  from "lodash/debounce";
import {Inertia} from '@inertiajs/inertia'

const form=useForm({
                    Start:'',
                    end:'',
                    types:props.types
                  })



const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Select date range',
                                                    html:
                                                        '<input id="swal-input1" type="date"  placeholder="From" class="swal2-input">' +
                                                        '<input id="swal-input2" type="date" placeholder="To"  class="swal2-input">',
                                                    focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form.Start=document.getElementById('swal-input1').value,
                                                                        form.end=document.getElementById('swal-input2').value
                                                                           form.post(route('zoom.meetings'),{
                                                                                        preserveScroll: true,
                                                                             onSuccess: () => Inertia.get(route('meeting.index'))}
                                                                           )
                                                                    }
                                                    })




const props=defineProps({ meetings:Object,
                             search:String,
                             types:Array,


                            })

const meeting_types=[
                        {name: 'zoom'},
                        {name: 'physical'},
                        {name: 'makeup'},

                    ]


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
  const filters=ref({
                            startDate:'',
                            endDate:'',
                            type:''
                        })

//   let searchKey=ref('')
//   const getRoute=computed(()=>route(`${props.model}'.index'`))
  watch(filters,debounce((value)=>{
                                    Inertia.get(route('meeting.index'),{'search':value},{preserveState:true,replace:true})
                                    },300),
                                     { deep: true });



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
                            <div class="flex flex-row gap-2">
                                <MultiSelect v-model="filters.type" :options="meeting_types" optionLabel="name" class="flex justify-right" placeholder="Meeting Types"

                                />
                                 <div class="field">
                                    <label for="date" class="mr-2">From</label>
                                    <InputText id="date" type="date" v-model="filters.startDate" aria-describedby="username1-help" />
                                    <!-- <small id="username1-help">Enter your username to reset your password.</small> -->
                                </div>

                                  <div class="field">
                                    <label for="date" class="mr-2">To</label>
                                    <InputText id="date" type="date"  v-model="filters.endDate" aria-describedby="username1-help" />
                                    <!-- <small id="username1-help">Enter your username to reset your password.</small> -->
                                </div>

                                    <!-- <SearchBox class="flex justify-left" :model="`meeting.index`" /> -->
                            </div>


                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" />
                        <Button icon="pi pi-calendar" class="mr-2 p-button-success" />
                        <Button icon="pi pi-times" class="p-button-danger" /> -->
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
