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
// import ScrollPanel from 'primevue/scrollpanel';
// const props = defineProps({
//   members: Object
// })


//    import 'flowbite';

/**
 *
 *
 */
 const country= ref(countries)
    const form = useForm({
                            date:'',
                            venue:'',
                            topic:'',
                            type:'',
                            host:'',
                            uuid:'',
                            gradable:true,
                             grading_rule_id:'',
                             club_id:1,
                             official_start_time:'',
                             official_end_time:'',
                             detail:''

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

 const createMeeting=()=>{
             form.post(route('meeting.store'), {
                        preserveScroll: true,
                        onSuccess: () => form.reset(),
                        })
         }

const props=defineProps({
                         clubs:Object,
                         grading_rules:Object
});
</script>

<template>
    <Head title="Create Meeting" />
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
                            Create Meeting
                            </div>

                    <div class="flex justify-center text-sm font-light ">
                        <BreezeValidationErrors class="mb-4" />
                    </div>

                    </template>
                    <template #content>


                        <form action="#" @submit.prevent="createMeeting()" >
                            <!-- <div class=" sm:rounded-md bottom-1 border-slate-200"> -->
                                <!-- <div class="grid w-full px-4 py-5 bg-white shadow md:col-span-2 sm:col-span-1 sm:p-6"> -->
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="Your Name" class="block text-sm font-medium text-gray-700">Date
                                            <span class="text-xs text-red-400">*</span>
                                             <i  />
                                        </label>
                                        <InputText
                                            type="date"
                                            name="name"
                                            required
                                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                            v-model="form.date"
                                            />
                                        <!-- <div v-if="errors.name" class="text-xs text-red">{{errors.name}}</div> -->

                                    </div>



                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Venue
                                            <span class="text-xs text-red-400">*</span>
                                        </label>
                                        <InputText
                                                    type="text"
                                                    name=""
                                                    required
                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.venue"
                                            />
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Topic
                                            <span class="text-xs text-red-400">*</span>
                                        </label>
                                        <InputText
                                                    type="text"
                                                    name="topic"
                                                    id="topic"
                                                    autocomplete="topic"
                                                    required
                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.topic"
                                            />
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Host</label>
                                        <InputText
                                                    type="text"
                                                    name="host"
                                                    id="host"
                                                    autocomplete="host"

                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.host"
                                            />
                                    </div>

                                     <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Official Start Time</label>
                                        <InputText
                                                    type="time"
                                                    name="Start Time"
                                                    id="Start Time"
                                                    autocomplete="Start Time"

                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.official_start_time"
                                            />
                                    </div>

                                     <div class="col-span-2 sm:col-span-1">
                                        <label for="email-address" class="block text-sm font-medium text-gray-700">Official End Time</label>
                                        <InputText
                                                    type="time"
                                                    name="End Time"
                                                    id="End Time"
                                                    autocomplete="End Time"

                                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                                    v-model="form.official_end_time"
                                            />
                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Type</label>
                                        <Dropdown
                                                v-model="form.type"
                                                :options="['physical','makeup']"

                                                placeholder="Meeting Type"
                                                />

                                    </div>
                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Grading Rule</label>
                                        <Dropdown
                                                v-model="form.grading_rule_id"
                                                :options="grading_rules"
                                                optionLabel="name"
                                                optionValue="id"
                                                placeholder="Grading Rule"
                                                />

                                    </div>

                                    <div class="col-span-2 sm:col-span-1">
                                        <label for="country" class="block text-sm font-medium text-gray-700">Club</label>
                                        <Dropdown
                                                v-model="form.club_id"
                                                :options="clubs"
                                                optionLabel="name"
                                                optionValue="id"
                                                placeholder="Club"
                                                />

                                     </div>


                                     <div class="col-span-2 sm:col-span-1">
                                       <Textarea v-model="form.detail" :autoResize="true" rows="5" cols="30" placeholder="Detail"  />
                                     </div>




                                <div class="col-span-2 sm:col-span-1 bg-gray-50">

                                   <div class="field-checkbox">
                                        <Checkbox id="binary" v-model="form.gradable" :binary="true" />
                                        <label for="binary">Gradable</label>
                                    </div>
                                      </div>
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
