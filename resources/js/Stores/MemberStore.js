
import { defineStore } from "pinia"

import axios from 'axios'
import Swal from "sweetalert2"
import _ from 'lodash';

export const useMemberStore=defineStore ('MemberStore',{

                    //state

                state: ()=>({

                    members:[],
                    guests:[],
                    // meetingMembers:[],
                }),


                    actions:
                    {
                        getters: {
                            getMembers(state){
                                return state.members
                            },
                            // getMeetingMembers(state){
                            //     return state.meetingMembers
                            // }


                        }, getFilteredGuests(searchKey){
                               return this.guests.filter(guest=>guest.name.toLowerCase().includes(this.searchKey.toLowerCase()))
                           },

                    async fetchMembers() {
                                            try {
                                            const {data}= await axios.get('/members/all')
                                                            this.members = data
                                                        }
                                            catch (error) {

                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    footer: `'<a href="">${error.message}</a>'`
                                                })
                                             }
                                         },

                    async fetchGuests() {
                        try {
                        const {data}= await axios.get('/guests/all')
                            this.guests = data
                        }
                        catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: `'<a href="">${error.message}</a>'`
                              })
                        }
                    },

                     async findGuest(name) {
                        try {
                    const {data}= await axios.get('/findGuest/',{'name':name})
                            this.guests = data
                        }
                        catch (error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                footer: `'<a href="">${error.message}</a>'`
                              })
                        }
                    }

                    // async fetchMeetingMembers(meeting) {
                    //     try {
                    //     const {data}= await axios.get(`${meeting}/members`)
                    //         this.meetingMembers = data
                    //     }
                    //     catch (error) {
                    //         alert(error)
                    //         console.log(error)
                    //     }
                    // }
                    },

                    //setters
                })
