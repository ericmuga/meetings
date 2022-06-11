<script setup>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>


    <div class="flex flex-col items-center min-h-screen pt-6 bg-gray-100 sm:justify-center sm:pt-0">
        <div>
            <Link href="/">
                <BreezeApplicationLogo class="w-20 h-20 text-gray-500 fill-current" />
            </Link>
            <!-- <div class="w-full my-3 tracking-wide text-center uppercase rounded-md bg-slate-300">
                club Manager
         </div> -->
        </div>
 <transition
          appear

          @before-enter="beforeEnter"
          @enter="enter"
        >
        <div class="w-full px-6 py-4 mt-6 overflow-hidden bg-white shadow-md sm:max-w-md sm:rounded-lg">


                    <slot />


        </div>
        </transition>
    </div>
</template>
