<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Card from 'primevue/card';
import { ref, reactive, onMounted } from 'vue';
//    import{countries} from '@/assets/countries.js'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
 import gsap from 'gsap';
 import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import MeetingCard from '@/Components/MeetingCard.vue'
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel'
import Checkbox from 'primevue/checkbox';
// import Timeline from 'primevue/timeline';
// import ScrollPanel from 'primevue/scrollpanel';
// const props = defineProps({
//   meetings: Object
// })


//    import 'flowbite';
//  const country= ref(countries)
const checked = ref(false);
 const props=defineProps({
                              meeting:Object,
                            //   members:Object,
                            //   guests:Object,
                              attended:Object,
                              MemberList:Object,
                              GuestList:Object                            //   meetings:Object,

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
                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                   <div class="grid p-6 md:grid-cols-5 sm:grid-cols-1">

                       <div class="gap-2 p-3 rounded-md shadow-md md:col-span-2 sm:col-span-1 shadow-slate-300">

                         <MeetingCard :meeting=meeting class="mt-10" />


                       </div>
                        <div class="rounded-md shadow-md md:col-span-3 sm:col-span-1 shadow-slate-300">

                          <div class="w-full tracking-wide text-center text-white uppercase bg-teal-500 rounded-lg">
                              meeting Stats
                          </div>

                          <div class="w-full">
                        <TabView>


                            <TabPanel header="Members" >
                                <div v-if="meeting.length==0">No Members were found for this meeting</div>
                                <div v-else>
                                    <Table>
                                        <!-- <td>{{meeting}}</td> -->
                                        <tr class="text-center">
                                            <th>Name</th>
                                            <th>Time Score</th>
                                            <th>Present</th>
                                        </tr>
                                        <tr v-for="member in meeting.members" :key="member.id" class="text-center">
                                            <td>{{member.name}}</td>
                                            <td>{{member.score.time_score}}</td>
                                            <td>{{member.score.present==1?'Yes':'No'}}</td>
                                        </tr>
                                    </Table>
                                    <div>
                                        <Table>
                                        <!-- <td>{{meeting}}</td> -->
                                        <tr class="text-center">
                                            <th>Name</th>
                                            <th>Time Score</th>
                                            <th>Present</th>
                                        </tr>
                                        <tr v-for="mem in meeting.MemberList" :key="mem.id" class="text-center">
                                            <td>{{mem.name}}</td>
                                            <td>0</td>
                                            <td><div class="field-checkbox">
                                                <Checkbox id="binary" v-model="checked" :binary="true" />
                                                <label for="binary">{{checked}}</label>
                                            </div></td>


                                           </tr>
                                        </Table>

                                    </div>

                                </div>

                            </TabPanel>


                            <TabPanel header="Guests">
                                  <div v-if="meeting.length==0">No guests were found for this meeting</div>
                                    <div v-else>
                                        <Table>
                                            <tr>
                                                <th>guest Name</th>
                                                <th>Time Score</th>
                                                <th>Present</th>
                                            </tr>
                                            <tr v-for="guest in meeting.guests" :key="guest.id">
                                                <td>{{guest.name}}</td>
                                                <td>{{guest.score.time_score}}</td>
                                                <td>{{guest.score.present==1?'Yes':'No'}}</td>
                                            </tr>
                                        </Table>
                                    </div>
                            </TabPanel>
                            <TabPanel header="Reports">
                                Reports
                            </TabPanel>
                            <TabPanel header="Stats">
                                Stats
                            </TabPanel>
                        </TabView>

                         </div>

                        </div>

                   </div>


              </transition>
                </div>
            </div>
     </div>
    </BreezeAuthenticatedLayout>
</template>
