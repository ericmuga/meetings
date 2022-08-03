<template>
    <div >
<div class="max-w-md px-8 py-4 my-8 bg-white rounded-lg shadow-lg">
  <div class="flex justify-center -mt-16 md:justify-end">
    <img class="object-cover w-10 h-10 border-2 border-indigo-500 rounded-full"
     :src="`/images/${meeting.icon}.png`"
    >
  </div>
  <div>
    <h3 class="flex justify-center text-3xl font-semibold text-gray-800">#0000{{meeting.id}}</h3>
    <!-- <p class=""></p> -->
    <p class="mt-2 text-gray-600">

    </p>

  </div>
<div class="flex justify-center">


<table class="pl-5 rounded-md table-auto">

  <tbody>
    <tr>
      <td class="text-left">Members</td>
      <td class="text-center">{{meeting.members_count}}</td>
    </tr>
     <tr>
      <td class="text-left">Guests</td>
      <td class="text-center">{{meeting.guests_count}}</td>
    </tr>

    <tr>
      <td class="text-left">Present</td>
      <td class="text-center">{{meeting.attended}}</td>
    </tr>
    <tr class="py-3">

    </tr>
    <tr class="bg-slate-300">
      <td class="text-left">Total</td>
      <td class="text-center">{{meeting.guests_count+meeting.members_count}}</td>
    </tr>


        <tr class="mt-5">
            <td class="font-bold text-left">Topic</td>
            <td class="text-right">{{meeting.topic}}</td>
        </tr>

          <tr>
            <td class="font-bold text-left">Venue</td>
            <td class="text-right">{{meeting.venue}}</td>
        </tr>

        <tr>
            <td class="font-bold text-left">Host</td>
            <td class="text-right">{{meeting.host}}</td>
        </tr>
    </tbody>
    </table>
</div>
   <p class="py-4 font-semibold text-center">{{meeting.official_start_time}}</p>
   <div class="flex flex-row justify-center space-x-2">
       <Link
         :href="route('meeting.show',meeting.id)"
       >
        <Button icon="pi pi-bookmark" class="p-button-rounded p-button-primary p-button-outlined" />

       </Link>
        <Button icon="pi pi-pencil" class="p-button-rounded p-button-primary p-button-outlined" />
        <Drop :dropRoute="route('meeting.destroy',meeting.id)" />

   </div>

  </div>
</div>


</template>

<script setup>
import {ref,toRefs} from 'vue'
import Drop from '@/Components/Drop.vue'
   const props= defineProps({meeting:Object})

</script>

<style lang="scss" scoped>

</style>
