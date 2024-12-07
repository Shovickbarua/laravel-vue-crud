import { createRouter, createWebHistory } from 'vue-router';
import CustomerList from '../pages/customers/CustomerList.vue';
import CustomerForm from '../pages/customers/CustomerForm.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        { path: '/', component:CustomerList},
        { path: '/create', component: CustomerForm },
        { path: '/edit/:id', component: CustomerForm, props: true },
    ],
  });

  export default router;