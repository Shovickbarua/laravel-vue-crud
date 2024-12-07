<script setup>
import { ref, onMounted } from 'vue';
import { RouterLink } from 'vue-router';
import TransactionApi from '../../api/TransactionApi';
import CustomerApi from '../../api/CustomerApi';

const customers = ref([]);
const showModal = ref(false);
const newTransaction = ref({
    full_name: '',
    age: '',
    email: '',
    phone: ''
});

onMounted(() => {
    getCustomer();
});

const getCustomer = async () => {
    const res = await CustomerApi.index();
    if (res.success) {
        customers.value = res.data.data;
    }
};

const customerDelete = async (id) => {
    const confirmMsg = confirm("Are you sure!");
    if (confirmMsg) {
        const res = await CustomerApi.delete(id);
        if (res.success) {
            getCustomer();
        }
    }
};

const saveTransaction = async () => {
    const res = await TransactionApi.save(newTransaction.value);
    if (res.success) {
        getCustomer();
        closeModal();
    }
};

const closeModal = () => {
    showModal.value = false;
    newTransaction.value = { customer_id: '', invoice_no: '', amount: '', created: '' }; 
};
</script>

<template>
    <div class="border max-w-7xl mx-auto mt-6 p-4 rounded-lg shadow-lg bg-white dark:bg-gray-800">
        <div>
            <button @click="showModal = true" class="mr-2 bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">
                Add Transaction
            </button>
            <RouterLink to="/create" class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow mb-4">
                Add
            </RouterLink>
        </div>
        <table class="table-auto w-full border-collapse border border-gray-200 dark:border-gray-600">
            <thead class="bg-gray-100 dark:bg-gray-700">
                <tr>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">ID</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Full Name</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Age</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Email</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Phone</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Transaction</th>
                    <th class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="customer in customers" :key="customer.id" class="odd:bg-white even:bg-gray-50 dark:odd:bg-gray-800 dark:even:bg-gray-700">
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.id }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.full_name }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.age }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.email }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.phone }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300">{{ customer.transactions_sum_amount ? customer.transactions_sum_amount : 0 }}</td>
                    <td class="px-4 py-2 border border-gray-200 dark:border-gray-600">
                        <div class="flex justify-center space-x-4">
                            <RouterLink :to="'/edit/' + customer.id" class="text-blue-600 dark:text-blue-500 hover:underline">
                                Edit
                            </RouterLink>
                            <button @click.prevent="customerDelete(customer.id)" class="text-red-600 dark:text-red-500 hover:underline">
                                Delete
                            </button>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div v-if="showModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 w-1/3">
                <h2 class="text-lg font-semibold mb-4">Add Transaction</h2>
                <form @submit.prevent="saveTransaction">
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Select Customer</label>
                        <select v-model="newTransaction.customer_id" class="w-full border px-4 py-2 rounded" required>
                            <option value="" disabled>Select a customer</option>
                            <option
                                v-for="customer in customers"
                                :key="customer.id"
                                :value="customer.id"
                            >
                                {{ customer.full_name }}
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Invoice No</label>
                        <input v-model="newTransaction.invoice_no" type="text" class="w-full border px-4 py-2 rounded" required />
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-1">Amount</label>
                        <input v-model="newTransaction.amount" type="number" class="w-full border px-4 py-2 rounded" required />
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" @click="closeModal" class="px-4 py-2 bg-gray-200 rounded">Cancel</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
