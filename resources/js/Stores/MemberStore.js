
import { defineStore } from "pinia"

import axios from 'axios'

export const useMemberStore=defineStore ('MemberStore',{

                    //state

                state: ()=>({

                    members:[],
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
                        },

                    async fetchMembers() {
                        try {
                        const {data}= await axios.get('/members/all')
                            this.members = data
                        }
                        catch (error) {
                            alert(error)
                            console.log(error)
                        }
                    },


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
