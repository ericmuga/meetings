<script setup>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue';
import MemberCard from '@/Components/MemberCard.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Toolbar from 'primevue/toolbar';
import { useForm } from '@inertiajs/inertia-vue3'
import Swal from 'sweetalert2'
 import gsap from 'gsap';

 import SearchBox from '@/Components/SearchBox.vue'
  const form = useForm({
                            member_list: null,
                            })

   const uploadMembers=()=>{
        form.post(route('members.import'))
   }


const form2 = useForm({
                            name:'',
                            field:'',
                            member_no:'',
                            email:'',
                             phone:'',
                             gender:'',
                            //  club:1,
                             nationality:''

                            })

const props=defineProps({ members:Object,
                             model:String,
                             search:String,
                             baseURL:String,
                             member_count:String,


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

const  showForm=({formValues})=>Swal.fire({
                                                    title: 'Create New Member',
                                                    html:
                                                        '<input id="name" type="text"  placeholder="Name*" class="swal2-input">' +
                                                        '<input id="email" type="email"  placeholder="email*" class="swal2-input" required>' +
                                                        '<input id="phone" type="text"  placeholder="Phone No.*" class="swal2-input" required>' +
                                                        '<input id="field" type="text"  placeholder="Field/Occupation" class="swal2-input" required>' +
                                                        '<input id="nationality" type="text"  placeholder="nationality" class="swal2-input" required>' +
                                                        '<input id="member_no" type="text"  placeholder="Member No.*" class="swal2-input" required>' +
                                                        '<select  id="gender" name="" type="text"  placeholder="Gender" class="swal2-input" required>' +
                                                            '<option  value="f">Female</option>' +
                                                            '<option  value="m">Male</option>' +
                                                        '</select>'
                                                        ,
                                                   focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form2.name=document.getElementById('name').value,
                                                                        form2.email=document.getElementById('email').value,
                                                                        form2.phone=document.getElementById('phone').value,
                                                                        form2.member_no=document.getElementById('member_no').value,
                                                                        form2.gender=document.getElementById('gender').value,
                                                                        form2.field=document.getElementById('field').value,
                                                                        form2.nationality=document.getElementById('nationality').value,
                                                                           form2.post(route('member.store'),{
                                                                                        preserveScroll: true,
                                                                                        onSuccess: () => Swal.fire(
                                                                                                                'Success!',
                                                                                                                'Member has been added.',
                                                                                                                'success')

                                                                             }
                                                                           )
                                                                    }
                                                    })


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
                        <!-- <Link :href="route('member.create')"> -->
                          <Button label="New" icon="pi pi-plus" class="mr-2" @click="showForm"/>
                        <!-- </Link> -->


                        <Form @submit.prevent="uploadMembers" class="flex flex-row ">
                        <FileUpload mode="basic"
                                name="demo[]"
                                url="./upload.php"
                                :maxFileSize="1000000"
                                chooseLabel="Upload Members"
                                @input="form.member_list = $event.target.files[0]"
                                data-tooltip-target="tooltip-default"
                                class="mr-2 p-button-success "

                                />
                          <!-- <Button   icon="pi pi-upload" class="mx-2 p-button-rounded p-button-secondary"/> -->
                        <Button v-if="form.member_list"
                               :disabled=form.progress
                               type="submit"
                               label="Upload" icon="pi pi-upload" class="p-button-primary" />
                        <!-- <i class="mr-2 pi pi-bars p-toolbar-separator" /> -->
                        <!-- <SplitButton label="Save" icon="pi pi-check" :model="items" class="p-button-warning"></SplitButton> -->
                            </Form>
                         <a :href="route('members.download')">
                          <Button label="Download" icon="pi pi-download" class="mr-2 p-button-secondary" />
                        </a>

                </template>

                    <template #end>
                         <Button disabled icon="pi pi-bolt" class="mr-2 p-button-warning" :label="`Total:${member_count}`" />
                        <span class="p-input-icon-left">
                            <i class="pi pi-search" />
                             <SearchBox :model="`member.index`" />

                        </span>
                        <!-- <Button icon="pi pi-search" class="mr-2" /> -->
                        <!-- <Button icon="pi pi-calendar" class="mr-2 p-button-success" /> -->
                        <!-- <Button icon="pi pi-times" class="p-button-danger" /> -->
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
                                        <MemberCard :member=member.data />
                                </transition>
                            </div>
</div>

                        <div class="w-full text-center">
                            <div v-if="members.data.length===0">
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
