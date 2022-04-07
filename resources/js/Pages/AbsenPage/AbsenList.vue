<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Absen List
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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Absen Type</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tapping Time</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">View Activity</th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(absen,index) in absenlist.data" :key="absen.email">
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="flex items-center">
                    <div class="ml-4">
                      <div class="text-sm font-medium text-gray-900">
                        {{ absen.name }}
                      </div>
                      <div class="text-sm text-gray-500">
                        {{ absen.email }}
                      </div>
                    </div>
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">{{ absen.posname }}</div>
                  <div class="text-sm text-gray-500">{{ absen.department }}</div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> {{ absen.absenvalue }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800"> {{ absen.created_at }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <jet-button @click="openModal(index)" class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                    Show
                  </jet-button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
            <div>
              <pagination class="mt-6" :links="absenlist.links" />
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

          <!-- Name -->
          <div class="">
            <jet-label for="name" value="Name" class="text-lg"/>
            <jet-input id="name" type="text" class="mt-1 block w-full" v-model="modalValue.name" autocomplete="name" disabled/>
          </div>

          <!-- Email -->
          <div class="mt-2">
            <jet-label for="email" value="Email" class="text-lg"/>
            <jet-input id="email" type="email" class="mt-1 block w-full" v-model="modalValue.email" disabled/>
          </div>

          <!-- absentype -->
          <div class="mt-2">
            <jet-label for="absentype" value="Absen Type" class="text-lg"/>
            <jet-input id="absentype" type="text" class="mt-1 block w-full" v-model="modalValue.absentype" disabled/>
          </div>

          <!-- tappingtime -->
          <div class="mt-2">
            <jet-label for="tapping" value="Tapping Time" class="text-lg"/>
            <jet-input id="tapping" type="text" class="mt-1 block w-full" v-model="modalValue.tappingtime" disabled/>
          </div>

          <!-- Activity -->
          <div class="mt-2">
            <jet-label for="activiy" value="Daily Activities" class="text-lg"/>
            <textarea id="activiy" v-model="modalValue.activity" disabled placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" ></textarea>
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
import AppLayout from '@/Layouts/AppLayout.vue';
import {defineComponent} from "vue";
import Pagination from '@/Jetstream/PaginationAction';
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetModal from "@/Jetstream/Modal";
import JetDialogModal from "@/Jetstream/DialogModal";
import JetLabel from '@/Jetstream/Label.vue';
import JetInput from '@/Jetstream/Input.vue';

export default defineComponent({
  name: "AbsenList",
  components:{
    AppLayout,
    Pagination,
    Link,
    JetButton,
    JetModal,
    JetDialogModal,
    JetLabel,
    JetInput
  },
  computed:{

  },
  props:['absenlist'],
  data(){
    return {
      searchValue: this.$inertia.form({
        search: ''
      }),
      show: false,
      modalValue: {
        name: '',
        email: '',
        absentype: '',
        activity: '',
        tappingtime: ''
      }
    }
  },
  methods:{
    searching(){
      this.searchValue.post('/absen/search/', {
        preserveScroll: false,
        onSuccess: () => {
          this.form.reset('search')
        }
      });
    },
    openModal(index){
      this.show = true;
      const newData = this.absenlist.data[index];
      this.modalValue.name = newData.name;
      this.modalValue.email = newData.email;
      this.modalValue.absentype = newData.absentype;
      this.modalValue.activity = newData.activity;
      this.modalValue.tappingtime = newData.created_at;
      console.log(newData);
    },
    close(){
      this.show = false;
    }

  }
})
</script>

