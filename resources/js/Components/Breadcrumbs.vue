<template>
      <div class="flex flex-col w-full p-3 mb-3 bg-slate-200 ">
        <div>
            <ul>
                <li v-for="bc in breadcrumbs" :key="bc.url" class="items-center inline-block text-center">
                    <Link
                    :href="bc.url"

                    class="text-xs font-medium uppercase"
                    >
                    {{bc.title}}  >
                    </Link>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
   props:{
       breadcrumbs:Object,
   },

   setup(props){
       const breadcrumbs= props.breadcrumbs;
       return {breadcrumbs}

   }
}
</script>
