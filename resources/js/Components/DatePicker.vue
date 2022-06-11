<template>
    <div class="flex flex-row justify-center w-full">
        <form @submit.prevent="searchMeetings">


            <div date-rangepicker="" class="flex items-center">
            <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <!-- <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg> -->
            </div>
            <InputText
                name="end"
                type="date"
                v-model="form.startDate"
                class="rounded rounded-md bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                placeholder="Select date end"
                />

            </div>
            <span class="mx-4 text-gray-500">to</span>
            <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
            <!-- <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg> -->
            </div>
              <InputText
                name="end"
                type="date"
                v-model="form.endDate"
                class="rounded rounded-md bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 datepicker-input"
                placeholder="Select date end"
                />
            </div>
            <Dropdown
            class="mx-2"
                 filter="true"
                 optionLabel="name"
                 placeholder="Choose Type"
                 :options="[
                            {name: 'Physical Meeting', code: 'PM'},
                            {name: 'Zoom Meeting', code: 'ZM'},
                            {name: 'Make-Up', code: 'MU'},
                            {name: 'All', code: 'ALL'}
                          ]"
                optionValue="code"

                v-model="form.type"

               />
              <Button icon="pi pi-send" type="submit" class="mx-1 p-button-success" />
              <Button type="button" @click="resetForm()" icon="pi pi-history" class="mx-3 p-button-secondary" />


            </div>
        </form>
    </div>
</template>

<script setup>
   import { watch,ref, computed, toRefs } from "@vue/runtime-core";
    import  debounce  from "lodash/debounce";
    import {Inertia} from '@inertiajs/inertia'
    import { MinusCircleIcon } from '@heroicons/vue/solid'
import { useForm } from "@inertiajs/inertia-vue3";

    const props=defineProps({model:String,
                                sd:Date,
                                ed:Date,
                                tp:String,
                                });
    const {model,sd,ed}= toRefs(props)
    const form= useForm(
                        {
                            startDate:props.sd,
                            endDate:props.ed,
                            type:props.tp
                        }
    )
    const searchMeetings=()=>{
            form.get(route('meetings.index'))
    }

    const resetForm=()=>(Inertia.get(route('meetings.index'),{'startDate':'','endDate':'','type':'ALL'}));
    // const emit =defineEmits('loadMembers');
    let items=null

    //   const getRoute=computed(()=>route(`${props.model}'.index'`))
    // watch(startDate,debounce((value)=>{
    //                                     Inertia.get(route(model.value),{'startDate':value},{preserveState:true,replace:true})
    //                                     },300));
    </script>

<style lang="scss" scoped>

</style>
