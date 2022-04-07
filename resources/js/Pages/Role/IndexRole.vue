<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Roles Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div class="flex">
            <div class="mb-3 xl:w-96">
              <form @submit.prevent="searching">
                <div class="input-group relative flex flex-wrap items-stretch w-full mb-4">
                  <input type="search" v-model="searchValue.search" class="form-control relative flex-auto min-w-0 block w-6 px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                  <button class="btn inline-block px-6 py-2.5 bg-blue-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-blue-700 hover:shadow-lg focus:bg-blue-700  focus:shadow-lg focus:outline-none focus:ring-0 active:bg-blue-800 active:shadow-lg transition duration-150 ease-in-out flex items-center" type="submit" id="button-addon2">
                    <svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="search" class="w-4" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                      <path fill="currentColor" d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"></path>
                    </svg>
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
            <table class="min-w-full divide-y divide-gray-200">
              <thead class="bg-gray-50">
              <tr>

                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  No
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Rolename
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Employee Name
                </th>
                <th
                  scope="col"
                  class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                >
                  Created At
                </th>
                <th scope="col" class="relative px-6 py-3">
                  <span class="sr-only">Edit</span>
                </th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(role, index) in roles.data" :key="role.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ index+1 }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ role.rolename }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{role.user_name}}
                  </div>
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"
                >
                  {{ role.created_at }}
                </td>
                <td
                  class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium"
                >

                  <jet-button
                    class="mr-1 bg-cyan-500 hover:bg-cyan-600"
                    title="Show"
                    @click="openModal(index,'show')"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                    </svg>
                  </jet-button>


                  <jet-button
                    class="mr-1 bg-teal-500 hover:bg-teal-600"
                    title="Edit"
                    @click="openModal(index,'edit')"
                  >
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                  </jet-button>

                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div>
            <pagination class="mt-6" :links="roles.links" />
          </div>
        </div>
      </div>
    </div>
    <jet-dialog-modal :show="show">
      <template #title>
        <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
          <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">View Acivity</h5>
        </div>
      </template>
      <template #content>
        <div class="modal-body relative p-4">

          <!-- rolename -->
          <div class="">
            <jet-label for="rolename" value="Role Name" class="text-lg"/>
            <jet-input id="rolename" type="text" class="mt-1 block w-full" v-model="modalValue.rolename" :disabled="isDisabled"/>
          </div>

          <!-- description -->
          <div class="mt-2">
            <jet-label for="description" value="Description Role" class="text-lg"/>
            <textarea id="address" class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="address" rows="3" cols="77" v-model="modalValue.description" :disabled="isDisabled"></textarea>
          </div>

          <!-- user_name -->
          <div class="mt-2">
            <jet-label for="user_name" value="User Name" class="text-lg"/>
            <jet-input id="user_name" type="text" class="mt-1 block w-full" v-model="modalValue.user_name" :disabled="isDisabled"/>
          </div>

          <!-- updated_at -->
          <div class="mt-2">
            <jet-label for="updated_at" value="Updated At" class="text-lg"/>
            <jet-input id="updated_at" type="text" class="mt-1 block w-full" v-model="modalValue.updated_at" :disabled="isDisabled"/>
          </div>

        </div>
      </template>
      <template #footer>
        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
          <button @click="close" type="button" class="px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
            Close
          </button>
        </div>
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>

<script>

import {defineComponent, ref} from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetLabel from '@/Jetstream/Label.vue';
import JetInput from '@/Jetstream/Input.vue';
import Pagination from '@/Jetstream/PaginationAction';
import JetDialogModal from "@/Jetstream/DialogModal";
import { useForm } from '@inertiajs/inertia-vue3'

export default defineComponent ({
  components: {
    AppLayout,
    Link,
    JetButton,
    Pagination,
    JetDialogModal,
    JetLabel,
    JetInput
  },
  props: ['roles'],
  setup(props){
    //console.log(props.roles.data);

    const show =  ref(false);
    const isDisabled = ref(true);


    const searchValue = useForm({
      search: ''
    });

    const modalValue = ref({
        id : '',
        rolename: '',
        description: '',
        user_name: '',
        created_at: '',
        updated_at: ''
    });

    const searching = () => {
        searchValue.post('/role/search',{
            preserveScroll: true,
            onSuccess: () => searchValue.reset('search'),
        })
    }

    const openModal = (index,action) => {
      if (action === 'edit'){
        isDisabled.value = false;
      }
      show.value = true;
      const newData = props.roles.data[index];
      modalValue.value.id = newData.id;
      modalValue.value.rolename = newData.rolename;
      modalValue.value.description = newData.description;
      modalValue.value.user_name = newData.user_name;
      modalValue.value.created_at = newData.created_at;
      modalValue.value.updated_at = newData.updated_at;
    }

    const close = () => {
      show.value = false;
    }

    return {
      searchValue,
      show,
      modalValue,
      isDisabled,
      searching,
      openModal,
      close
    }
  }
});
</script>

<style scoped>

</style>
