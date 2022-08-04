<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
// import guestCard from '@/Components/GuestCard'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Card from 'primevue/card';
import { ref, reactive } from 'vue';
   import{countries} from '@/assets/countries.js'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
 import gsap from 'gsap';
 import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import guestCard from '@/Components/guestCard.vue'

 const country= ref(countries)

 const props=defineProps({
                              guest:Object,
                              meetings:Object,

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
    <Head title="Guests" />
    <BreezeAuthenticatedLayout>
     <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                   <div class="grid p-6 md:grid-cols-5 sm:grid-cols-1">

                       <div class="gap-2 p-3 rounded-md shadow-md md:col-span-2 sm:col-span-1 shadow-slate-300">

                      <guestCard :guest=guest.data />
                       </div>
                        <div class="rounded-md shadow-md md:col-span-3 sm:col-span-1 shadow-slate-300">

                          <div class="w-full tracking-wide text-center text-white uppercase bg-teal-500 rounded-lg">
                              Guest Stats
                          </div>

                          <div class="w-full">
                                <Accordion :activeIndex="0">
                                    <AccordionTab header="Meetings Attended">
                                       <div v-if="meetings.length==0">
                                           <p>No meetings were found</p>
                                       </div>


                                  <div class="relative overflow-x-auto" v-else>
                                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">


                                                <tr scope="col" class="px-6 py-3" >
                                                   <th>Date</th>
                                                   <th>Topic</th>
                                                   <th>Score</th>
                                               </tr>
                                            </thead>


                                        <tr v-for="m in meetings" :key="m.id">
                                                <td class="px-6 py-4">{{m.meeting.date}}</td>
                                                <td class="px-6 py-4">{{m.meeting.topic}}</td>
                                                <td class="px-6 py-4">{{m.present}}</td>
                                         </tr>

                                         </table>
                                       </div>




                                     </AccordionTab>
                                      <AccordionTab header="Contacts">
                                         <table>
                                             <tr>
                                                 <th>Type</th>
                                                 <th>Contact</th>
                                                 <th>Default</th>
                                                 <!-- <th>Actions</th> -->

                                             </tr>
                                             <tr v-for="contact in guest.data.contacts" :key="contact.id" >
                                                 <td class="p-2" v-if="contact.contact_type=='email'">
                                                     <i class="pi pi-envelope"></i>
                                                 </td>
                                                  <td class="p-2" v-else>
                                                     <i class="pi pi-phone"></i>
                                                 </td>
                                                 <td class="p-2">{{contact.contact}}</td>
                                                 <td class="p-2">{{contact.default==1?'Yes':'No'}}</td>
                                                 </tr>
                                         </table>
                                          <Link :href="route('guest.create')">
                                            <Button label="New" icon="pi pi-plus" class="mr-2" />
                                        </Link>
                                    </AccordionTab>


                                    <AccordionTab header="Inviter">
                                         <table>

                                             <tr>
                                                    <td class="p-2">{{guest.data.inviter}}</td>

                                            </tr>
                                         </table>

                                    </AccordionTab>

                                    <AccordionTab header="History">

                                    </AccordionTab>
                                </Accordion>
                          </div>

                        </div>

                   </div>


              </transition>
                </div>
            </div>
     </div>
    </BreezeAuthenticatedLayout>
</template>
