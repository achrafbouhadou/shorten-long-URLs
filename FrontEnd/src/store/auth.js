import { defineStore } from 'pinia';
import axios from 'axios';

export const useAuthUser = defineStore('auth', {
    state: () => ({ 
        authUser: null
    }),
    getters: {  
      user: (state) => state.authUser,
    },
    actions: {
      async getToken(){
        await axios.get('/sanctum/csrf-cookie');
      },
      async getUser(){
        await this.getToken();
        const data = await axios.get('/api/user');
        this.authUser = data.data;
        return this.authUser
      }, 
      async handleLogin(data){
       
        await this.getToken();
          await axios.post('/login',data);
          this.router.push("/")
       
      

      },
      async handleRegister(data) {
        try {
          await this.getToken();
          await axios.post('/register' , data);
          this.router.push('/')
        } catch (error) {
          
        }
      },
      async handleLogout(){
        await axios.post('/logout');
        this.authUser = null
        this.router.push("/login")
      }

    },

  })