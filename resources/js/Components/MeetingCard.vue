<template>
    <div >

<div class="max-w-md px-8 py-4 my-8 bg-white rounded-lg shadow-lg">
  <div class="flex justify-center -mt-16 md:justify-end">
    <img class="object-cover w-10 h-10 border-2 border-indigo-500 rounded-full"
     :src="`/images/${m.icon}.png`"
    >
  </div>
  <div>
    <h3 class="flex justify-center text-3xl font-semibold text-gray-800">{{m.index}}</h3>
    <!-- <p class=""></p> -->
    <p class="mt-2 text-gray-600">

    </p>

  </div>

  <!-- <div class="flex justify-between"> -->
    <!-- <div class="tracking-wide text-white">Members</div> -->
    Members {{members}}: <LVProgressBar :value="Math.round(members/nonZero(),2)" :showValue="true" color="#0abaf0" />
    Guests {{guests}}: <LVProgressBar :value="Math.round(guests/nonZero(),2)" :showValue="true" color="#d69d0d" />
        <div v-for="g in _.keys(m.guestAttended)" :key="g" class="ml-10" >
                    {{g=='None'?'Other':g}}s: {{m.guestAttended[g].length}}
            <LVProgressBar  :value="Math.round(m.guestAttended[g].length/guests*100,2)" :showValue="true" :color="resolveColor(g)"/>
        </div>





   <div class="p-3 m-4 text-center text-white rounded-md bg-slate-600">Total :{{total}}</div>

<!-- </div> -->
<div class="flex justify-center">


<table class="pl-5 rounded-md table-auto">

  <tbody>



        <tr class="mt-5">
            <td class="font-bold text-left">Topic</td>
            <td class="text-right">{{m.topic}}</td>
        </tr>

          <tr>
            <td class="font-bold text-left">Venue</td>
            <td class="text-right">{{m.venue}}</td>
        </tr>

        <tr>
            <td class="font-bold text-left">Host</td>
            <td class="text-right">{{m.host}}</td>
        </tr>
    </tbody>
    </table>
</div>
   <p class="py-4 font-semibold text-center">{{m.date}}</p>
   <div class="flex flex-row justify-center space-x-2">
       <!-- <Link
         :href="route('meeting.show',m.id)"
       > -->
        <Button icon="pi pi-bookmark" class="p-button-rounded p-button-primary p-button-outlined" />

       </Link>
        <Button icon="pi pi-pencil" class="p-button-rounded p-button-primary p-button-outlined" />
        <!-- <Drop :dropRoute="route('meeting.destroy',m.id)" /> -->

   </div>

  </div>
</div>


</template>

<script setup>
import {onMounted, ref,toRefs} from 'vue'
import Drop from '@/Components/Drop.vue'
import LVProgressBar from 'lightvue/progress-bar';
import _ from 'lodash'

   const props= defineProps({meeting:Object})
   const m =ref({})
   onMounted(()=>{
    if (meeting.id>0)
    {
        m.value=meeting;
    }
    else
    {
        m.value=meeting.data
    }
   })
  const value1 = ref(20);
  const total =props.meeting.members_count+props.meeting.guests_count;
  const members =props.meeting.members_count;
  const guests =props.meeting.guests_count;
  const nonZero=()=>(total==0)?100:total/100;
  const resolveColor=function(g){
                                if(g=='Rotarian') return '#a80327'
                                if(g=='Rotaractor') return '#00d11f'
                                if(g=='None') return '#635f63'
                            }



</script>

<style scoped>


</style>
