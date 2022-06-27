<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
// import MemberCard from '@/Components/MemberCard'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Card from 'primevue/card';
import { ref, reactive } from 'vue';
   import{countries} from '@/assets/countries.js'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
 import gsap from 'gsap';
 import InputNumber from 'primevue/inputnumber';

const showSuccess=()=>{swal('Success',message,'success')};


 const country= ref(countries)
    const form = useForm({
                            name:'',
                            min_members:'',
                            min_minutes:'',
                            meeting_type:'',
                            start_time:'',
                            })

//    const uploadMembers=()=>{
//         form.post(route('members.upload'))
//    }


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

 const createrule=()=>{
             form.post(route('grading.store'), {
                        preserveScroll: true,
                         onSuccess: () =>showSuccess('Rule created'),
                        })
         }

const props=defineProps({
                         clubs:Object,
                         grading_rules:Object
});
</script>

<template>
    <Head title="Members" />
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
                            Create rule
                            </div>

                    <div class="flex justify-center text-sm font-light ">
                        <BreezeValidationErrors class="mb-4" />
                    </div>

                    </template>
                    <template #content>


                        <form action="#" @submit.prevent="createrule()" >
                            <!-- <div class=" sm:rounded-md bottom-1 border-slate-200"> -->
                                <!-- <div class="grid w-full px-4 py-5 bg-white shadow md:col-span-2 sm:col-span-1 sm:p-6"> -->
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="rule-name" class="block text-sm font-medium text-gray-700">Rule Name
                                            <span class="text-xs text-red-400">*</span>
                                        </label>
                                        <InputText
                                                    type="text"
                                                    name=""
                                                    required
                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.name"
                                            />
                                    </div>


                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Members" class="block text-sm font-medium text-gray-700">Minimum Members
                                            <span class="text-xs text-red-400">*</span>
                                             <i  />
                                        </label>
                                        <InputNumber  v-model="form.min_members" mode="decimal" showButtons :min="0" :max="100" />
                                        <!-- <div v-if="errors.name" class="text-xs text-red">{{errors.name}}</div> -->

                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Minutes" class="block text-sm font-medium text-gray-700">Minimum Minutes
                                            <span class="text-xs text-red-400">*</span>
                                             <i  />
                                        </label>
                                        <InputNumber  v-model="form.min_minutes" mode="decimal" showButtons :min="0" :max="100" />
                                        <!-- <div v-if="errors.name" class="text-xs text-red">{{errors.name}}</div> -->

                                    </div>

                                        <div class="col-span-2 sm:col-span-1">
                                        <label for="start time" class="block text-sm font-medium text-gray-700">Official Start Time</label>
                                        <InputText
                                                    type="time"
                                                    name="Start Time"
                                                    id="Start Time"
                                                    autocomplete="Start Time"

                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.start_time"
                                            />
                                        </div>



                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Meeting Type</label>
                                        <Dropdown
                                                v-model="form.meeting_type"
                                                :options="['physical','makeup','zoom']"

                                                placeholder="Meeting Type"
                                                />

                                    </div>



<br>


                                <div class="col-span-2 sm:col-span-1 bg-gray-50">
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
