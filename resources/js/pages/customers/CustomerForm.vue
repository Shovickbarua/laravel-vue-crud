<script setup>
import { onMounted, ref } from 'vue';
import CustomerApi from '../../api/CustomerApi';
import { useRouter } from 'vue-router';

const props = defineProps({
  id: {
    required: true,
    type: String,
  },
});

const customer = ref({
    full_name: '',
    age: '',
    email: '',
    phone: ''
});
const router = useRouter();

onMounted(() => {
if (props.id) {
    showCustomer(props.id);
  }
});

const showCustomer = async (id) => {
  const res = await CustomerApi.show(id);
  if (res.success) {
    customer.value = res.data.data;
  }
};

const handleSubmit = async () => {
  const res = await CustomerApi.save(customer.value);
  if (res.success) {
    router.push('/');
  }
};

</script>

<template>
    <div class="max-w-7xl p-6 mx-auto">
        <form @submit.prevent="handleSubmit">
            <div class="grid grid-cols-2">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 capitalize dark:text-white">
                        {{ props.id ? 'Edit' : 'Add' }} Customer
                    </h2>
                </div>
                <div class="flex justify-end">
                    <button
                        type="submit"
                        class="px-6 py-2 leading-5 text-white transition-colors duration-200 transform bg-gray-700 rounded-md hover:bg-gray-600 focus:outline-none focus:bg-gray-600"
                    >
                        Submit
                    </button>
                </div>
            </div>

            <div class="mt-4 flex gap-6">
                <div class="w-7/12 gap-4">
                    <div>
                        <label class="text-gray-700 dark:text-gray-200" for="name">Full Name</label>
                        <input
                            id="name"
                            type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            v-model="customer.full_name"
                            required
                        />
                    </div>

                    <div class="mt-2">
                        <label class="text-gray-700 dark:text-gray-200" for="age">Age</label>
                        <input
                            id="age"
                            type="number"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            v-model="customer.age"
                            required
                        />
                    </div>

                    <div class="mt-2">
                        <label class="text-gray-700 dark:text-gray-200" for="email">Email</label>
                        <input
                            id="email"
                            type="email"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            v-model="customer.email"
                            required
                        />
                    </div>

                    <div class="mt-2">
                        <label class="text-gray-700 dark:text-gray-200" for="phone">Phone</label>
                        <input
                            id="phone"
                            type="text"
                            class="block w-full px-4 py-2 mt-2 text-gray-700 bg-white border border-gray-300 rounded-md dark:bg-gray-800 dark:text-gray-300 dark:border-gray-600 focus:border-blue-500 dark:focus:border-blue-500 focus:outline-none focus:ring"
                            v-model="customer.phone"
                            required
                        />
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
