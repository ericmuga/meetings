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
 import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import MemberCard from '@/Components/MemberCard.vue'
// import Timeline from 'primevue/timeline';
// import ScrollPanel from 'primevue/scrollpanel';
// const props = defineProps({
//   members: Object
// })


//    import 'flowbite';
 const country= ref(countries)

 const props=defineProps({
                              member:Object,
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
                   <div class="grid p-6 md:grid-cols-5 sm:grid-cols-1">

                       <div class="gap-2 p-3 rounded-md shadow-md md:col-span-2 sm:col-span-1 shadow-slate-300">

                      <MemberCard :member=member.data />
                       </div>
                        <div class="rounded-md shadow-md md:col-span-3 sm:col-span-1 shadow-slate-300">

                          <div class="w-full tracking-wide text-center text-white uppercase bg-teal-500 rounded-lg">
                              Member Stats
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
                                                <td class="px-6 py-4">{{m.time_score}}</td>
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
                                             <tr v-for="contact in member.data.contacts" :key="contact.id" >
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
                                          <Link :href="route('member.create')">
                                            <Button label="New" icon="pi pi-plus" class="mr-2" />
                                        </Link>
                                    </AccordionTab>
                                    <AccordionTab header="Makeups Attended">
                                        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Consectetur, adipisci velit, sed quia non numquam eius modi.</p>
                                    </AccordionTab>
                                    <AccordionTab header="Attendance Score">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.</p>
                                    </AccordionTab>
                                     <AccordionTab header="Guests invited">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.</p>
                                    </AccordionTab>
                                      <AccordionTab header="Communications">
                                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus.</p>
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
