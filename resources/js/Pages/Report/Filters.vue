<template>
    <div>
       <div v-for="filter in filters" :key="filter.id">
           <div v-if="filter.type ==='text'">
              <InputText
                :placeholder="filter.name"
              />
           </div>
           <div v-else>
               {{filter.name}}
                <Dropdown
                />
           </div>
       </div>
    </div>
</template>

<script setup>
   const filters=defineProps({filters:Object})
</script>

<style lang="scss" scoped>

</style>
