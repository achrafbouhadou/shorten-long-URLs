import { createRouter , createWebHistory } from "vue-router";

const Home = () => import('../components/pages/Home.vue');
const Login = () => import('../components/pages/Login.vue');
const Register = () => import('../components/pages/Register.vue');

const routes = [
    {path : "/"  ,name:'home', component : Home,},
    {path : "/login"  ,name:'login', component : Login,},
    {path : "/register"  , name:'register', component : Register,}
]

const router = createRouter(
    {
        history:createWebHistory(),
        routes,
        linkActiveClass:'active'
    }
)
export default router