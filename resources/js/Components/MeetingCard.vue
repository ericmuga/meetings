<template>
    <div >
<div class="max-w-md px-8 py-4 my-8 bg-white rounded-lg shadow-lg">
  <div class="flex justify-center -mt-16 md:justify-end">
    <img class="object-cover w-10 h-10 border-2 border-indigo-500 rounded-full"
     :src="`/images/${meeting.icon}.png`"
    >
  </div>
  <div>
    <h3 class="text-3xl font-semibold text-gray-800">{{meeting.date}}</h3>
    <!-- <p class="">{{meeting.meeting_date_humans}}</p> -->
    <p class="mt-2 text-gray-600">

    </p>
  </div>
  <div class="flex flex-col mt-4 text-center">
   <p>Members {{meeting.members}}</p>
   <p>Guests {{meeting.guest}}</p>
   <p>Total {{meeting.guests+meeting.members}}</p>
   <div class="flex flex-row justify-center space-x-2">
       <Link
         :href="route('meeting.show',meeting.id)"
       >
        <Button icon="pi pi-bookmark" class="p-button-rounded p-button-primary p-button-outlined" />

       </Link>
        <Button icon="pi pi-pencil" class="p-button-rounded p-button-primary p-button-outlined" />
        <Button icon="pi pi-times" class="p-button-rounded p-button-danger p-button-outlined" />
   </div>

  </div>
</div>

    </div>
</template>

<script setup>
import {ref,toRefs} from 'vue'
   const props= defineProps({meeting:Object})

</script>

<style lang="scss" scoped>

</style>
