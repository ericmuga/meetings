<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Card from 'primevue/card';
import { ref, reactive, onMounted, watch } from 'vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
 import gsap from 'gsap';
 import Accordion from 'primevue/accordion';
import AccordionTab from 'primevue/accordiontab';
import MeetingCard from '@/Components/MeetingCard.vue'
import TabView from 'primevue/tabview';
import TabPanel from 'primevue/tabpanel'
import Checkbox from 'primevue/checkbox';
import {useScoreStore} from '@/Stores/ScoreStore'
import {useMemberStore} from '@/Stores/MemberStore'
import ScrollPanel from 'primevue/scrollpanel';
// import {computed} from 'vue'
import _ from 'lodash'
// import filter from 'lodash/filter'
// import axios from 'axios';
import Swal from 'sweetalert2'
import SearchBox from '@/Components/SearchBox.vue'

// const scoreStore=useScoreStore()



let searchKey=ref('')
//   const getRoute=computed(()=>route(`${props.model}'.index'`))
  watch(searchKey,_.debounce((value)=>{

            if (searchKey!='')
                allGuests= _.filter(allGuests,{'name':value});
            else allGuests=allGuests2;
        },300));



const memberStore=useMemberStore()

const form=useForm({
                        attended:props.meeting.members,
                        guestsAttended:props.meeting.guests,
                        meeting:props.meeting.id
                    })

    const save=()=>form.post(route('meeting.scores'),{
                             preserveScroll: true,
                            onSuccess:()=>Swal.fire(
                                                'Saved',
                                                'Attendance has been saved',
                                                'success'
                                            )
                                            })




onMounted(() => {
   memberStore.fetchMembers()
   memberStore.fetchGuests()
   const allGuests=memberStore.guests
   const allGuests2=memberStore.guests

})

// const filter=(obj,predicate)=>{_.filter(obj,predicate)}
 const props=defineProps({
                              meeting:Object,
                              attended:Object,

                                                        //   meetings:Object,

                         })

const requests={}

const form2 = useForm({
                            name:'',
                            field:'',
                            email:'',
                             phone:'',
                             gender:'',
                             club:1,
                             nationality:'',
                             type:'',

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
                            <div class="flex flex-col w-full">
                                <div class="justify-end">
                                   <Button type="submit" v-if="meeting.type!='zoom'" class="p-3 pi pi-check icon-left p-button-raised p-button-success" @click="save()" label="Save"/>

                                </div>

                            </div>


                          <div class="w-full">
                        <TabView>


                            <TabPanel header="Members" v-if="meeting.type!='makeup'" >
                                <div v-if="meeting.length==0">No Members were found for this meeting</div>
                                <div v-else>
                                   <div class="flex flex-row justify-right">



                                   <div v-if="meeting.type=='zoom'">
                                        <Link
                                          :href="route('zoom.participants',meeting.id)"
                                          >
                                            <Button
                                            type="button"
                                                class="float-left p-3 pi pi-download p-button-success icon-left"
                                            >
                                             Participants
                                            </Button>
                                        </Link>

                                         <Link
                                          :href="route('zoom.grade',meeting.id)"
                                          >
                                            <Button
                                            type="button"
                                                class="float-left p-3 pi pi-check p-button-warning icon-left"
                                            >
                                             Grade
                                            </Button>
                                        </Link>


                                    </div>
                                     </div>
                                   <div class="p-5 col-12 md:col-4">
                                     <ScrollPanel style="width: 100%; height: 200px" class="custombar1">
                                    <Table>
                                        <tr class="text-center">
                                            <th>Name</th>
                                            <th>Present</th>
                                        </tr>

                                            <tr v-for="member in memberStore.members" :key="member.id" class="text-center">
                                                <td>
                                                    <Link
                                                      :href="route('member.show',member.id)"
                                                     >
                                                        {{member.name}}
                                                    </Link>
                                                </td>
                                                <td>

                                                <form @submit.prevent="save()">
                                                    <div class="field-checkbox">
                                                        <Checkbox id="binary" v-model="form.attended" :value="member.id"  :disabled="meeting.type=='zoom'" />
                                                    </div>
                                                </form>
                                                </td>

                                            </tr>


                                    </Table>
                                       </ScrollPanel>
                                         </div>

                                    <div>

                                    </div>

                                </div>

                            </TabPanel>


                            <TabPanel header="Guests" v-if="meeting.type!='makeup'">
                                  <div v-if="meeting.length==0">No guests were found for this meeting</div>
                                   <!-- <SearchBox :model="member"/> -->
                                    <div v-else>
                                        <div class="gap-2">


                                        <span class="p-input-icon-left">
                                            <i class="pi pi-search" />
                                            <InputText type="text" v-model="searchKey" placeholder="Search" />
                                       </span>

                                      <Button class="ml-3" label="New" icon="pi pi-user" @click="showForm" />
                                            </div>

                                        <ScrollPanel style="width: 100%; height: 200px" class="custombar1">

                                        <Table>
                                            <tr class="text-center">
                                                <th>Name</th>
                                                <!-- <th>Time Score</th> -->
                                                <th>Present</th>
                                            </tr>

                                                <tr v-for="guest in allGuests" :key="guest.id" class="text-center">
                                                    <td>
                                                        <Link
                                                        :href="route('guest.show',guest.id)"
                                                        >
                                                            {{guest.name}}
                                                        </Link>
                                                    </td>
                                                    <td>

                                                    <form @submit.prevent="save()">
                                                        <div class="field-checkbox">
                                                            <Checkbox id="binary" v-model="form.guestsAttended" :value="guest.id"  :disabled="meeting.type=='zoom'" />
                                                        </div>
                                                    </form>
                                                    </td>

                                                </tr>
                                        </Table>
                                          </ScrollPanel>
                                    </div>
                            </TabPanel>

                            <TabPanel header="Requests" v-if="meeting.type=='makeup'">

                                      <div class="relative overflow-x-auto shadow-md sm:rounded-lg" v-if="meeting.requests.data.length>0">

                                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                                    <tr>
                                                        <th scope="col" class="px-6 py-3">
                                                            Date
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Description
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Requested By
                                                        </th>

                                                        <th scope="col" class="px-6 py-3">
                                                            Approve
                                                        </th>
                                                        <th scope="col" class="px-6 py-3">
                                                            Action
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="bg-white border-b dark:bg-gray-900 dark:border-gray-700"
                                                        v-for="request in meeting.requests.data" :key=request.id
                                                      >
                                                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                            {{request.makeup_date}}
                                                        </th>
                                                        <td class="px-6 py-4">
                                                            {{request.description}}
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            {{request.member}}
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            <Checkbox id="binary" v-model="checked" :binary="true" />
                                                        </td>

                                                        <td class="px-6 py-4">
                                                            <Link :href="route('makeup.edit',request.id)" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Details</Link>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>


                            </TabPanel>
                            <TabPanel header="Approved Requests" v-if="meeting.type=='makeup'">
                                Approved Requests
                            </TabPanel>
                            <TabPanel header="Reports">
                                Reports
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


