<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MemberCard from '@/Components/MemberCard'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'

 import gsap from 'gsap';
// import ScrollPanel from 'primevue/scrollpanel';
// const props = defineProps({
//   members: Object
// })


//    import 'flowbite';

    const form = useForm({
                            member_list: null,
                            })

//    const uploadMembers=()=>{
//         form.post(route('members.upload'))
//    }

const props=defineProps({ members:Object,
                             model:String,
                             search:String,
                             baseURL:String,


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
    <Head title="Members" />

    <BreezeAuthenticatedLayout>
        <!-- <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Members

            </h2>
        </template> -->
         <div class="py-6">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                   <Toolbar>
                    <template #start>
                        <Link :href="route('member.create')">
                          <Button label="New" icon="pi pi-plus" class="mr-2" />
                        </Link>

                        <Button label="Upload" icon="pi pi-upload" class="p-button-success" />
                        <i class="mr-2 pi pi-bars p-toolbar-separator" />
                        <SplitButton label="Save" icon="pi pi-check" :model="items" class="p-button-warning"></SplitButton>
                    </template>

                    <template #end>
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                            <InputText type="text" v-model="value3" placeholder="Search" />
                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <Button icon="pi pi-calendar" class="mr-2 p-button-success" />
                        <Button icon="pi pi-times" class="p-button-danger" />
                    </template>
                </Toolbar>

                    <div class="w-full text-center">
                            <div v-if="members.data.length===0">
                                No members were found
                            </div>

                            <div v-else>
                                <Pagination :links=members.links :prefix=model />
                            </div>

                        </div>
                    <div class="grid justify-center gap-2 m-6 bg-white border-b border-gray-200 sm:grid-cols-1 md:grid-cols-4">

                             <div class="col-span-1" v-for="member in members.data" :key="member.id">
                                <transition
                                        appear
                                         @before-enter="beforeEnter"
                                        @enter="enter"
                                    >
                                        <member-card :member=member />
                                </transition>
                            </div>
</div>

                        <div class="w-full text-center">
                            <div v-if="members.data.length===0">
                                No members were found
                            </div>
                            <div v-else>
                                <Pagination :links=members.links :prefix=model />
                            </div>
                        </div>




                </div>
            </div>
         </div>

    </BreezeAuthenticatedLayout>
</template>
