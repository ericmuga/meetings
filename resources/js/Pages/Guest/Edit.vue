<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Card from 'primevue/card';
import { ref, reactive, onMounted } from 'vue';
import{countries,types} from '@/assets/countries.js'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
 import gsap from 'gsap';
import Swal from 'sweetalert2'
import _ from 'lodash'

 const country= ref(countries)
 const type=ref(types)
 const props=defineProps({guest:Object,members:Object,clubs:Object});
    const form = useForm({
                            name:props.guest.data.name,
                            field:props.guest.data.field,
                            member_id:props.guest.data.member_id,
                            email:props.guest.data.email,
                             phone:props.guest.data.phone,
                             gender:props.guest.data.gender,
                             nationality:props.guest.data.nationality,
                             type:props.guest.data.type,
                             club_id:props.guest.data.club_id
                            //  inviter:props.guest.data.inviter,

                            })

// const showSuccess=()=>{swal('Success',message,'success')};



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

 const editguest=()=>{
             form.put(route('guest.update',props.guest.data.id), {
                        preserveScroll: true,
                        onSuccess: () =>Swal.fire(
                                                'Success!',
                                                'Details Updated Successfully.',
                                                'success')
                        })
         }

const members=props.members
// const inviter=()=>!_.isNull(props.data.member_id)?_.filter(members,{id:props.guest.data.member_id})[0].name:'Inviter'

</script>

<template>
    <Head title="guests" />
    <BreezeAuthenticatedLayout>
     <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                   <Card class="flex justify-center m-10">
                    <template #title class="bg-slate-200 ">
                        <div class="w-full p-2 font-light tracking-wide text-center rounded-lg bg-slate-300">
                            Edit guest
                            </div>

                    <div class="flex justify-center text-sm font-light ">
                        <BreezeValidationErrors class="mb-4" />
                    </div>

                    </template>
                    <template #content>


                        <form action="#" @submit.prevent="editguest()" >
                            <!-- <div class=" sm:rounded-md bottom-1 border-slate-200"> -->
                                <!-- <div class="grid w-full px-4 py-5 bg-white shadow md:col-span-2 sm:col-span-1 sm:p-6"> -->
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Your Name" class="block text-sm font-medium text-gray-700">Guest Name
                                            <span class="text-xs text-red-400">*</span>
                                        </label>
                                        <InputText
                                            type="text"
                                            name="name"
                                            id="name"
                                            autocomplete="name"
                                            required
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="form.name"
                                            />
                                        <!-- <div v-if="errors.name" class="text-xs text-red">{{errors.name}}</div> -->

                                    </div>



                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Email Address
                                            <span class="text-xs text-red-400">*</span>
                                        </label>
                                        <InputText
                                                    type="email"
                                                    name="email-address"
                                                    id="email-address"
                                                    autocomplete="email"
                                                    required
                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.email"
                                            />
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Invited By</label>
                                        <Dropdown
                                                v-model="form.member_id"
                                                :options="props.members"
                                                optionLabel="name"
                                                optionValue="id"
                                                :placeholder=props.guest.data.inviter
                                                />

                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Phone Number</label>
                                        <InputText
                                                    type="text"
                                                    name="phone-number"
                                                    id="phone-number"
                                                    autocomplete="phone"

                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.phone"
                                            />
                                    </div>

                                     <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Type</label>
                                        <Dropdown
                                                v-model="form.type"
                                                :options="types"
                                                optionLabel="name"
                                                optionValue="code"
                                                :placeholder=props.guest.data.type
                                                />

                                    </div>

                                    <div class="col-span-2 sm:col-span-1" v-if="form.type!='None'">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Club</label>
                                        <Dropdown
                                                v-model="form.club_id"
                                                :options="props.clubs"
                                                optionLabel="name"
                                                optionValue="id"
                                                :placeholder=props.guest.data.club
                                                />

                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Nationality</label>
                                        <Dropdown
                                                v-model="form.nationality"
                                                :options="countries"
                                                optionLabel="name"
                                                optionValue="code"
                                                :placeholder=props.guest.data.nationality
                                                />

                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Field" class="block text-sm font-medium text-gray-700">Field</label>
                                        <InputText
                                                    type="text"
                                                    name="field"
                                                    id="field"
                                                    autocomplete="phone"
                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.field"
                                            />
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Field" class="block text-sm font-medium text-gray-700">Gender</label>
                                        <Dropdown
                                                v-model="form.gender"
                                                :options="[{name:'Male',code:'m'},{name:'Female',code:'f'}]"
                                                optionLabel="name"
                                                optionValue="code"
                                                :placeholder=props.guest.data.gender
                                                />
                                    </div>

                                <div class="col-span-2 px-4 py-3 text-right sm:col-span-1 bg-gray-50 sm:px-6">
                                 <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
                                </div>

 </div>


                                <!-- </div> -->

                            <!-- </div> -->
                            </form>



                     </template>
                </Card>



              </transition>
                </div>
            </div>
     </div>
    </BreezeAuthenticatedLayout>
</template>
