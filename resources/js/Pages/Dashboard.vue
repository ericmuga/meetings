<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import { Head } from '@inertiajs/inertia-vue3';

import gsap from 'gsap';
const props= defineProps({
                            members:Object,
                            guests:Object,
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
                                    <div class="grid gap-4 p-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4 place-items-center">
                                         <div class="max-w-sm col-span-1 p-3 overflow-hidden rounded shadow-lg">
                                            <img class="w-full max-h-48" src="/images/member.jpg" alt="Member Gravatar" >
                                            <div class="flex justify-center px-6 py-4">
                                                <div class="mb-2 text-xl font-bold ">Members</div>
                                            </div>
                                              <p class="text-base text-center text-gray-700">
                                                    {{members}}
                                                </p>
                                            <div class="px-6 pt-4 pb-2 text-center">
                                                <Link :href="route('member.index')">
                                                    <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">Explore</span>
                                                </Link>
                                            </div>
                                         </div>


                                        <div class="max-w-sm col-span-1 p-3 overflow-hidden rounded shadow-lg ">
                                            <img class="w-full max-h-48" src="/images/guest.png" alt="Member Gravatar" >
                                            <div class="flex justify-center px-6 py-4">
                                                <div class="mb-2 text-xl font-bold ">Guests</div>
                                            </div>
                                              <p class="text-base text-center text-gray-700">
                                                    {{guests}}
                                                </p>
                                            <div class="px-6 pt-4 pb-2 text-center">
                                                <Link :href="route('member.index')">
                                                    <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">Explore</span>
                                                </Link>
                                            </div>
                                         </div>

                                         <div class="max-w-sm col-span-1 p-3 overflow-hidden rounded shadow-lg ">
                                            <img class="w-full max-h-48" src="/images/meeting.png" alt="Member Gravatar" >
                                            <div class="flex justify-center px-6 py-4">
                                                <div class="mb-2 text-xl font-bold ">Meetings</div>
                                            </div>
                                              <p class="text-base text-center text-gray-700">
                                                    {{meetings}}
                                                </p>
                                            <div class="px-6 pt-4 pb-2 text-center">
                                                <Link :href="route('meeting.index')">
                                                    <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">Explore</span>
                                                </Link>
                                            </div>
                                         </div>

                                         <div class="max-w-sm col-span-1 p-3 overflow-hidden rounded shadow-lg ">
                                            <img class="w-full max-h-48" src="/images/reports.jpg" alt="Member Gravatar" >
                                            <div class="flex justify-center px-6 py-4">
                                                <div class="mb-2 text-xl font-bold ">Reports</div>
                                            </div>

                                            <div class="px-6 pt-4 pb-2 text-center">
                                                <Link :href="route('meeting.index')">
                                                    <span class="inline-block px-3 py-1 mb-2 mr-2 text-sm font-semibold text-gray-700 bg-gray-200 rounded-full">Explore</span>
                                                </Link>
                                            </div>
                                         </div>

                                    </div>
                             </transition>



                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>
