<template>
  <footer class="py-4 ">
    <div class="container px-4 mx-auto">
      <hr class="mb-4 border-b-1 border-blueGray-200" />
      <div
        class="flex justify-center flex-auto w-full place-items-center "
      >

          <div
            class="py-1 text-sm font-semibold text-center text-blueGray-500 md:text-left"
          >
            Copyright © {{ date }}
            <a
              href="https://www.creative-tim.com?ref=vn-footer-admin"
              class="py-1 text-sm font-semibold text-blueGray-500 hover:text-blueGray-700"
            >
              {{appName}}
            </a>

        </div>

      </div>
    </div>
  </footer>
</template>
<script>
import { computed, defineComponent } from "@vue/runtime-core";
import {usePage} from '@inertiajs/inertia-vue3'
export default defineComponent({
//   props:{company},
  setup() {
   const appName= computed(()=>usePage().props.value.appName)
   return {
      date: new Date().getFullYear(),
      appName
    };
  },
});
</script>
