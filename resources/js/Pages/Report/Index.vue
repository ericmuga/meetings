<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';
import ReportCard from '@/Pages/Report/ReportCard.vue';

import gsap from 'gsap';
const props= defineProps({
                            reports:Object

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
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Dashboard
            </h2>
        </template> -->

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <!-- <div class="p-4 bg-red-200"> -->

                            <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                                    <div class="grid gap-4 p-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4 place-items-center"

                                     >
                                        <div  v-for="report in reports" :key="report.id">

                                            <report-card :report=report />
                                        </div>
                                    </div>
                             </transition>



                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
