<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Active Assignment List

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
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Code</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Description</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Module Name & Sequence</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Transaction Code & ID</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment</th>
                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
              </tr>
              </thead>
              <tbody class="bg-white divide-y divide-gray-200">
              <tr v-for="(assignment,index) in wfassignment.data" :key="assignment.id">
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 font-semibold text-green-800"> {{ assignment.assignment_code }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 text-green-800"> {{ assignment.description }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ assignment.modulename }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ assignment.sequence }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <div class="text-sm text-gray-900">
                    {{ assignment.codetransaction }}
                  </div>
                  <div class="text-sm text-gray-500">
                    {{ assignment.ownertrxid }}
                  </div>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <span class="px-2 inline-flex text-xs leading-5 text-green-800"> {{ assignment.assignperson }} </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap">
                  <jet-button @click="openModal(assignment)" type="button" class="mr-1 bg-cyan-500 hover:bg-cyan-600">
                    Reroute
                  </jet-button>
                </td>
              </tr>
              </tbody>
            </table>
          </div>
          <div>
            <pagination class="mt-6" :links="wfassignment.links" />
          </div>
        </div>
      </div>
    </div>
  </app-layout>
  <jet-dialog-modal :show="show">
    <template #title>
      <div class="modal-header flex flex-shrink-0 items-center justify-between p-4 border-b border-gray-200 rounded-t-md">
        <h5 class="text-xl font-medium leading-normal text-gray-800" id="exampleModalLabel">View Acivity</h5>
      </div>
    </template>
    <template #content>
      <form >
        <div class="modal-body relative p-4">
          <!-- assignment_code -->
          <div class="mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
            <jet-label for="assignment_code" value="Assignment Code" class="text-lg"/>
            <jet-input id="assignment_code" type="text" class="mt-1 block w-full" v-model="form.assignment_code" disabled/>
          </div>
          <!-- assignment_code -->
          <!-- description -->
          <div class="mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
            </svg>
            <jet-label for="description" value="Description" class="text-lg"/>
            <textarea id="description" v-model="form.description" disabled class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="assignment_code" rows="3" cols="62"  ></textarea>
          </div>
          <!-- assignment_description -->

          <!-- sequence -->
          <div class="">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
            </svg>
            <jet-label for="sequence" value="Sequence Approval" class="text-lg"/>
            <jet-input id="sequence" type="number" class="mt-1 block w-full" v-model="form.sequence"/>
          </div>
          <!-- sequence -->

          <!-- modulename -->
          <div class="mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
            <jet-label for="modulename" value="Module Name" class="text-lg"/>
            <jet-input id="modulename" type="text" class="mt-1 block w-full" v-model="form.modulename" disabled/>
          </div>
          <!-- modulename -->

          <!-- codetransaction -->
          <div class="mt-1">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
            </svg>
            <jet-label for="codetransaction" value="Code Transaction" class="text-lg"/>
            <jet-input id="codetransaction" type="text" class="mt-1 block w-full" v-model="form.codetransaction" disabled/>
          </div>
          <!-- codetransaction -->

          <!-- assignmetoid -->
          <div class="mt-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
            </svg>
            <Listbox v-model="selectedassignmetoid" as="div">
              <ListboxLabel class="block text-lg">
                Assignment Person
              </ListboxLabel>
              <div class="mt-1 relative">
                <ListboxButton
                  class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                      <span class="flex items-center">
                        <img
                          :src="selectedassignmetoid.profile_photo_url"
                          alt=""
                          class="flex-shrink-0 h-6 w-6 rounded-full"
                        />
                        <span class="ml-3 block truncate">
                          {{ selectedassignmetoid.name + " - " + selectedassignmetoid.posname }}
                        </span>
                      </span>
                  <span
                    class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none"
                  >
                        <SelectorIcon
                          aria-hidden="true"
                          class="h-5 w-5 text-gray-400"
                        />
                      </span>
                </ListboxButton>

                <transition
                  leave-active-class="transition ease-in duration-100"
                  leave-from-class="opacity-100"
                  leave-to-class="opacity-0"
                >
                  <ListboxOptions
                    class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm"
                  >
                    <ListboxOption
                      v-for="person in listuser"
                      :key="person.id"
                      v-slot="{ active, selected }"
                      :value="person"
                      as="template"
                    >
                      <li
                        :class="[
                              active
                                ? 'text-white bg-indigo-600'
                                : 'text-gray-900',
                              'cursor-default select-none relative py-2 pl-3 pr-9',
                            ]"
                      >
                        <div class="flex items-center">
                          <img
                            :src="person.profile_photo_url"
                            alt=""
                            class="flex-shrink-0 h-6 w-6 rounded-full"
                          />
                          <span
                            :class="[
                                  selected ? 'font-semibold' : 'font-normal',
                                  'ml-3 block truncate ',
                                ]"
                          >
                                {{ person.name + " - " + person.posname }}
                              </span>
                        </div>

                        <span
                          v-if="selected"
                          :class="[
                                active ? 'text-white' : 'text-indigo-600',
                                'absolute inset-y-0 right-0 flex items-center pr-4',
                              ]"
                        >
                              <CheckIcon aria-hidden="true" class="h-5 w-5" />
                            </span>
                      </li>
                    </ListboxOption>
                  </ListboxOptions>
                </transition>
              </div>
            </Listbox>
          </div>
          <!-- assignmetoid -->


        </div>
      </form>
    </template>
    <template #footer>
      <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
        <button @click="close" type="button" class="px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
          Close
        </button>
        <button @click="reassign" type="button" class="ml-2 mr-2 px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
          Reassign
        </button>
      </div>
    </template>
  </jet-dialog-modal>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import {defineComponent} from "vue";
import Pagination from '@/Jetstream/PaginationAction';
import { Link } from "@inertiajs/inertia-vue3";
import JetButton from "@/Jetstream/Button";
import JetLabel from '@/Jetstream/Label.vue';
import JetInput from '@/Jetstream/Input.vue';
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'
import JetDialogModal from "@/Jetstream/DialogModal";
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";


export default defineComponent({
  name: "ActiveAssignment",
  components:{
    AppLayout,
    Pagination,
    Link,
    JetButton,
    JetLabel,
    JetInput,
    JetDialogModal,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props:['wfassignment','listuser'],
  data(){
    return {
      searchValue: this.$inertia.form({
        search: ''
      }),
      show: false,
      form: this.$inertia.form({
        id: '',
        assignment_code: '',
        description: '',
        sequence: '',
        assignstatus: '',
        modulename: '',
        codetransaction: '',
        origperson: '',
        origpersonid: '',
        assignperson: '',
        assignpersonid: '',
      }),
      selectedassignmetoid: {}
    }
  },
  methods: {
    openModal(objectassignment){
      this.show = true;
      this.form.id = objectassignment.id;
      this.form.assignment_code   = objectassignment.assignment_code;
      this.form.description       = objectassignment.description;
      this.form.sequence          = objectassignment.sequence;
      this.form.assignstatus      = objectassignment.assignstatus;
      this.form.modulename        = objectassignment.modulename;
      this.form.codetransaction   = objectassignment.codetransaction;
      this.form.origperson        = objectassignment.origperson;
      this.form.origpersonid      = objectassignment.origpersonid;
      this.form.assignperson      = objectassignment.assignperson;
      this.form.assignpersonid    = objectassignment.assignpersonid;
      this.selectedassignmetoid = this.listuser.find((u) => u.id === objectassignment.assignpersonid);
    },
    close(){
      this.show = false;
      this.form.id   = '';
      this.form.assignment_code   = '';
      this.form.description       = '';
      this.form.sequence          = '';
      this.form.assignstatus      = '';
      this.form.modulename        = '';
      this.form.codetransaction   = '';
      this.form.origperson        = '';
      this.form.origpersonid      = '';
      this.form.assignperson      = '';
      this.form.assignpersonid    = '';
      this.selectedassignmetoid = {}
    },
    reassign(){
      this.form.assignperson      = this.selectedassignmetoid.name;
      this.form.assignpersonid    = this.selectedassignmetoid.id;
      this.form.put('/wfassignment/'+this.form.id, {
        preserveScroll: false,
        onSuccess: () => {
          this.notif('Success', this.$page.props.flash.message, 'success');
          this.close();
        },
        onError: () => {
          this.notif('Error Occured', 'Please Read The Errors Message At The Column Field', 'danger');
          this.close();
        }
      });
    },
    searching() {
      this.searchValue.post('/applicant/search', {
        preserveScroll: false,
        onSuccess: () => {
          this.form.reset('search')
        }
      });
    },
    notif(title,description,type){
      createToast(
        {
          title: title,
          description: description
        },
        {
          showIcon: 'true',
          hideProgressBar: 'false',
          transition: 'slide',
          type: type,
        }
      )
    },
  }
})
</script>

<style scoped>

</style>
