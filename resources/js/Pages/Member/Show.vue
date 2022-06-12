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
import MemberCard from '@/components/MemberCard'
import Timeline from 'primevue/timeline';
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

 const events1 = ref([
            {status: 'Ordered', date: '15/10/2020 10:30', icon: 'pi pi-shopping-cart', color: '#9C27B0', image: 'game-controller.jpg'},
            {status: 'Processing', date: '15/10/2020 14:00', icon: 'pi pi-cog', color: '#673AB7'},
            {status: 'Shipped', date: '15/10/2020 16:15', icon: 'pi pi-shopping-cart', color: '#FF9800'},
            {status: 'Delivered', date: '16/10/2020 10:00', icon: 'pi pi-check', color: '#607D8B'}
        ]);
        const events2 = ref([
            "2020", "2021", "2022", "2023"
        ]);
</script>
<style lang="scss" scoped>
.custom-marker {
    display: flex;
    width: 2rem;
    height: 2rem;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    border-radius: 50%;
    z-index: 1;
}

::v-deep(.p-timeline-event-content)
::v-deep(.p-timeline-event-opposite) {
    line-height: 1;
}

@media screen and (max-width: 960px) {
    ::v-deep(.customized-timeline) {
            .p-timeline-event:nth-child(even) {
                flex-direction: row !important;

                .p-timeline-event-content {
                    text-align: left !important;
                }
            }

            .p-timeline-event-opposite {
                flex: 0;
            }

            .p-card {
                margin-top: 1rem;
            }
        }
}
</style>

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
                                       <table>
                                          <tr v-for="meeting in meetings">
                                            <td>{{meeeting.date}}</td>
                                            <td>{{meeeting.host}}</td>
                                            <td>{{meeeting.topic}}</td>
                                          </tr>
                                       </table>
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
                                       <div class="card">
                                            <h5>Opposite Content</h5>
                                            <Timeline :value="events1">
                                                <template #opposite="slotProps">
                                                    <small class="p-text-secondary">{{slotProps.item.date}}</small>
                                                </template>
                                                <template #content="slotProps">
                                                    {{slotProps.item.status}}
                                                </template>
                                            </Timeline>
                                        </div>
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
