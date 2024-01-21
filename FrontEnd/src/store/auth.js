import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthUser = defineStore('alerts', {
    state: () => ({ 
        authUser: null
    }),
    getters: {  
      user: (state) => state.authUser,
    },
    actions: {
      
      async getUser(){
        await axios.get('http://localhost:8000/sanctum/csrf-cookie');
        const data = await axios.get('/api/user');
        this.authUser = data.data;
      }, 
      async handleLogin(data){
       
          await axios.get('http://localhost:8000/sanctum/csrf-cookie');
          await axios.post('/login',data);
          this.router.push("/")
       
      

      },
      async handleRegister(data) {
        try {
          await axios.get('http://localhost:8000/sanctum/csrf-cookie');
          await axios.post('/register' , data);
          this.router.push('/')
        } catch (error) {
          
        }
      }

    },

  })