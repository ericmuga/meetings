<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import guestCard from '@/Components/guestCard.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Swal from 'sweetalert2'
 import gsap from 'gsap';

 import SearchBox from '@/Components/SearchBox.vue'
import { onMounted } from '@vue/runtime-core';

const form = useForm({
                            guest_list: null,
                            })

   const uploadguests=()=>{
        form.post(route('guests.import'))
   }


const form2 = useForm({
                            name:'',
                            field:'',
                            guest_no:'',
                            email:'',
                             phone:'',
                             gender:'',
                             member_id:'',
                             club:1,
                             nationality:'',
                             type:'',

                            })

const props=defineProps({
                            guests:Object,
                             model:String,
                             search:String,
                             baseURL:String,
                             members:String,


                            })

const members= props.members

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

const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Create New guest',
                                                    html:
                                                        '<input id="name" type="text"  placeholder="Name*" class="swal2-input">' +
                                                        '<input id="email" type="email"  placeholder="email*" class="swal2-input" required>' +
                                                        '<input id="phone" type="text"  placeholder="Phone No.*" class="swal2-input" required>' +
                                                        '<input id="field" type="text"  placeholder="Field/Occupation" class="swal2-input" required>' +
                                                        '<input id="nationality" type="text"  placeholder="Nationality" class="swal2-input" required>' +
                                                        '<select  id="gender" name="" type="text"  placeholder="Gender" class="swal2-input" required>' +
                                                            '<option  value="f">Female</option>' +
                                                            '<option  value="m">Male</option>' +
                                                        '</select>'+
                                                        '<br/><label style="margin-top:3px">Invited By</label>'+
                                                        '<select id="member_id" name="member_id" placeholder="Invited By" class="swal2-input">'+
                                                            members+
                                                        '</select>'+
                                                        ' <select  id="type" name="type" type="text" class="swal2-input" required>' +
                                                            '<option  value="Rotarian">Rotarian</option>' +
                                                            '<option  value="Rotaractor">Rotaractor</option>' +
                                                            '<option  value="None">None</option>' +
                                                        '</select>'
                                                        ,
                                                   focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form2.name=document.getElementById('name').value,
                                                                        form2.email=document.getElementById('email').value,
                                                                        form2.phone=document.getElementById('phone').value,
                                                                        form2.gender=document.getElementById('gender').value,
                                                                        form2.member_id=document.getElementById('member_id').value,
                                                                        form2.field=document.getElementById('field').value,
                                                                        form2.type=document.getElementById('type').value,
                                                                        form2.nationality=document.getElementById('nationality').value,
                                                                        form2.post(route('guest.store'),{
                                                                                        preserveScroll: true,
                                                                                        onSuccess: () => Swal.fire(
                                                                                                                'Success!',
                                                                                                                'Guest has been added.',
                                                                                                                'success')

                                                                             }
                                                                           )
                                                                    }
                                                    })


</script>

<template>
    <Head title="guests" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                guests

            </h2>
        </template> -->

         <div class="py-6">
            <div class="flex justify-center text-sm font-light ">
                        <BreezeValidationErrors class="mb-4" />
                    </div>
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                   <Toolbar>
                    <template #start>
                        <!-- <Link :href="route('guest.create')"> -->
                          <Button label="New" icon="pi pi-plus" class="mr-2" @click="showForm"/>



                </template>

                    <template #end>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                             <SearchBox :model="`guest.index`" />

                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <!-- <Button icon="pi pi-calendar" class="mr-2 p-button-success" /> -->
                        <!-- <Button icon="pi pi-times" class="p-button-danger" /> -->
                    </template>
                </Toolbar>

                    <div class="w-full text-center">
                            <div v-if="guests.data.length===0">
                                No guests were found
                            </div>

                            <div v-else>
                                <Pagination :links=guests.links :prefix=model />
                            </div>

                        </div>
                    <div class="grid justify-center gap-2 m-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4">

                             <div class="col-span-1" v-for="guest in guests.data" :key="guest.id">
                                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                                        <guestCard :guest=guest />
                                </transition>
                            </div>
</div>

                        <div class="w-full text-center">
                            <div v-if="guests.data.length===0">
                                                         </div>
                            <div v-else>
                                <Pagination :links=guests.links :prefix=model />
                            </div>
                        </div>




                </div>
            </div>
         </div>

    </BreezeAuthenticatedLayout>
</template>
