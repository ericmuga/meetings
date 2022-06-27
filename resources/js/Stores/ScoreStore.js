import { defineStore } from "pinia";

import axios from 'axios'

export const useScoreStore=defineStore ('ScoreStore',{

                    //state

                state: ()=>({

                    scores:[],
                }),


                    actions:
                    {
                        getters: {
                            getScores(state){
                                return state.scores
                            }
                        },
                    async fetchScores(meeting) {
                        try {
                        const {data}= await axios.get(`/scores/${meeting}`)
                            this.scores = data
                        }
                        catch (error) {
                            alert(error)
                            console.log(error)
                        }
                    }
                    },

                    //setters
                })
