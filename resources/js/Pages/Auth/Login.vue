<script setup>
import BreezeButton from '@/Components/Button.vue';
import BreezeCheckbox from '@/Components/Checkbox.vue';
import BreezeGuestLayout from '@/Layouts/Guest.vue';
import BreezeInput from '@/Components/Input.vue';
import BreezeLabel from '@/Components/Label.vue';
import BreezeValidationErrors from '@/Components/ValidationErrors.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import Swal from 'sweetalert2';


const props=defineProps({
                canResetPassword: Boolean,
                status: String,
                memberSelect:String,
            });

const form = useForm({
                        email: '',
                        password: '',
                        remember: false
                    });

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};

const memberSelect=props.memberSelect


const form2 = useForm({
                            date:'',
                            description:'',
                            detail:'',
                            category:'',
                            member_id:'',
                            })






// const memberSelect=memberSelect

const  showForm=({formValues})=>Swal.fire({
                                                    title: 'New Makeup Request',
                                                    html:
                                                        '<br/><label>Name</label>'+
                                                        '<br/>'+
                                                        '<select  id="member_id"  type="text"  placeholder="member" class="my-2 rounded-md" required>' +
                                                           memberSelect+
                                                        '</select>'+
                                                        '<br/><label>Date</label>'+
                                                        '<br/>'+
                                                        '<input id="date" type="date"  placeholder="Date*" class="p-2 my-2 rounded-md">' +

                                                        '<input id="description" type="text"  placeholder="Description*" class="my-4 rounded-md" required>' +

                                                        '<select  id="category"  type="text"  placeholder="Category" class="my-2 rounded-md required>' +
                                                            '<option  value=""></option>' +
                                                            '<option  value=""></option>' +
                                                            '<option  value="Committee Meeting">Committee Meeting</option>' +
                                                            '<option  value="Club Visit">Club Visit</option>' +
                                                            '<option  value="Projects">Projects</option>' +
                                                            '<option  value="Social">Social</option>' +
                                                            '<option  value="Training">Training</option>' +
                                                            '<option  value="Board Meeting">Board Meeting</option>' +
                                                            '<option  value="other">Other Activity</option>' +
                                                        '</select>'+

                                                        '<textarea id="detail" rows="4" cols="25" class="p-3 rounded-md" placeholder="Details*"></textarea>'
                                                        ,

                                                   focusConfirm: false,
                                                    preConfirm: () => {
                                                                        form2.date=document.getElementById('date').value,
                                                                        form2.description=document.getElementById('description').value,
                                                                        form2.detail=document.getElementById('detail').value,
                                                                        form2.category=document.getElementById('category').value,
                                                                        form2.member_id=document.getElementById('member_id').value,

                                                                           form2.post(route('makeup.store'),{
                                                                                        preserveScroll: true,
                                                                                        onSuccess: () => Swal.fire(
                                                                                                                'Success!',
                                                                                                                'Makeup request has been added.',
                                                                                                                'success')

                                                                             }
                                                                           )
                                                                    }
                                                    })
</script>

<template>
    <BreezeGuestLayout>
        <Head title="Log in" />

        <BreezeValidationErrors class="mb-4" />

        <div v-if="status" class="mb-4 text-sm font-medium text-green-600">
            {{ status }}
        </div>
        <div class="p-2 m-3 text-center">
                <Button label="Makeup request"  class="text-center" @click="showForm"/>
        </div>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="block w-full mt-1" v-model="form.email" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="block w-full mt-1" v-model="form.password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <BreezeCheckbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link v-if="canResetPassword" :href="route('password.request')" class="text-sm text-gray-600 underline hover:text-gray-900">
                    Forgot your password?
                </Link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>

    </BreezeGuestLayout>
</template>
