<template>
  <app-layout title="Dashboard" pathImage="../../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Absen Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submit()">
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
            </template>


            <template #form>
              <!-- rolecode -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="rolecode" value="Role Code" />
                <jet-input id="rolecode" type="text" class="mt-1 block w-full" v-model="form.rolecode" disabled/>
                <jet-input-error :message="form.errors.assignment_code" class="mt-2" />
              </div>
              <!-- rolecode At -->

              <!-- rolename -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="rolename" value="Role Name" />
                <jet-input id="rolename" type="text" class="mt-1 block w-full" v-model="form.rolename" autocomplete="name" disabled/>
                <jet-input-error :message="form.errors.assignment_name" class="mt-2" />
              </div>
              <!-- rolename -->

              <!-- created_by -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="created_by" value="Created By" />
                <jet-input id="created_by" type="text" class="mt-1 block w-full" v-model="form.created_by" autocomplete="name" disabled/>
              </div>
              <!-- created_by -->

              <!-- description -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="description" value="Role Description" />
                <textarea id="description" placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" v-model="form.description"></textarea>
              </div>
              <!-- description -->

              <!-- Assignment Detail -->
              <div class="col-span-6 sm:col-span-6">
                <jet-button type="button" @click="openModal" class="mb-2 bg-cyan-500 hover:bg-cyan-600">
                  Add Data Assignment Detail
                </jet-button>
                <jet-label for="history" value="Assignment Detail" class="mb-1"/>
                <div id="history" class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Code & Rolename</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Extended</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(rolesdetail,index) in roledetail" :key="rolesdetail.id">
                      <td class="px-3 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                          {{ rolesdetail.rolecode }}
                        </div>
                        <div class="text-sm text-gray-500">
                          {{ rolesdetail.rolename }}
                        </div>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ rolesdetail.user_name }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ rolesdetail.extend }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <jet-button type="button" :disabled="rolesdetail.extend === 'EXTENDED'" @click="deleteAssignmentDetail(index)" class="mb-2 bg-red-500 hover:bg-red-600">
                          Delete
                        </jet-button>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
                <jet-input-error :message="form.errors.rowData" class="mt-2" />
              </div>
              <!-- Assignment Detail -->

            </template>

            <template #actions>
              <Link href="/roleheader" class="">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600 mr-2" >Back</jet-button>
              </Link>

              <jet-button class="bg-cyan-500 hover:bg-cyan-600 object-left" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Submit
              </jet-button>
            </template>
          </jet-form-section>
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
        <form >
          <div class="modal-body relative p-4">
            <!-- rolecode -->
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
              </svg>
              <jet-label for="formassignmentdetailobjtrolename" value="Role Code" class="text-lg"/>
              <jet-input id="formassignmentdetailobjtrolename" disabled type="text" class="mt-1 block w-full" v-model="formassignmentdetailobjt.rolecode"/>
            </div>
            <!-- rolecode -->

            <!-- rolename -->
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
              </svg>
              <jet-label for="formassignmentdetailobjtrolename" value="Role Name" class="text-lg"/>
              <jet-input id="formassignmentdetailobjtrolename" disabled type="text" class="mt-1 block w-full" v-model="formassignmentdetailobjt.rolename"/>
            </div>
            <!-- rolename -->

            <!-- user_name -->
            <div class="mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              <Listbox v-model="selectedassignmetoid" as="div">
                <ListboxLabel class="block text-lg">
                  Assign Person To This Role
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
                        v-for="person in user"
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
          <button @click="add" type="button" class="ml-2 mr-2 px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
            Add
          </button>
        </div>
      </template>
    </jet-dialog-modal>
  </app-layout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import {defineComponent} from "vue";
import { Link } from '@inertiajs/inertia-vue3';
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
  name: "EditRole",
  props: ['user','roleheader','roledetail'],
  components: {
    AppLayout,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetActionMessage,
    JetButton,
    Link,
    JetDialogModal,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  data() {
    return {
      show: false,
      form: this.$inertia.form({
        id: this.roleheader.id,
        rolecode: this.roleheader.rolecode ,
        rolename: this.roleheader.rolename ,
        description: this.roleheader.description ,
        created_by: this.roleheader.created_by ,
        created_byid: this.roleheader.created_byid ,
        rowData: this.roledetail,
      }),
      formassignmentdetailobjt: {
        rolename: this.roleheader.rolename ,
        user_id: '' ,
        rolecode: this.roleheader.rolecode ,
        roleheader_id: '' ,
        user_name: '' ,
        description: '' ,
        extend: '' ,
        doaid: null ,
      },
      selectedassignmetoid: this.user[0],
    }
  },
  methods: {
    openModal() {
      this.show = true;
      console.log(this.assignment);
    },
    close() {
      this.show = false;
    },
    deleteAssignmentDetail(index) {
      this.form.rowData.splice(index, 1);
    },
    add() {
      let isExecute = true;
      if (isExecute) {
        let tempObjt = {};

        tempObjt.rolename = this.roleheader.rolename;
        tempObjt.user_id = this.selectedassignmetoid.id;
        tempObjt.rolecode = this.roleheader.rolecode;
        tempObjt.roleheader_id = this.roleheader.id;
        tempObjt.user_name = this.selectedassignmetoid.name;
        tempObjt.description = '';
        tempObjt.extend = '';
        tempObjt.doaid = null;

        this.form.rowData.push(tempObjt);
        this.form.rowData = this.form.rowData.sort(function(a,b){
          if (a.user_name < b.user_name) {
            return -1;
          }
          if (a.user_name > b.user_name) {
            return 1;
          }
          return 0;
        });
        //clear Data After Add.
        this.formassignmentdetailobjt.rolename = this.roleheader.rolename ;
        this.formassignmentdetailobjt.user_id = '' ;
        this.formassignmentdetailobjt.rolecode = this.roleheader.rolecode ;
        this.formassignmentdetailobjt.roleheader_id = '' ;
        this.formassignmentdetailobjt.user_name = '' ;
        this.formassignmentdetailobjt.description = '' ;
        this.formassignmentdetailobjt.extend = '' ;
        this.formassignmentdetailobjt.doaid = null ;
        this.selectedassignmetoid = this.user[0];
      }

      this.close();
    },
    notif(title, description, type) {
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
    submit() {
      this.form.put('/roleheader/'+this.roleheader.id, {
        preserveScroll: false,
        onSuccess: () => {
          this.notif('Success', this.$page.props.flash.message, 'success');
          this.form.reset('activity')
          this.form.absentype = 'invalid'
        },
        onError: () => {
          this.notif('Error Occured', 'Please Read The Errors Message At The Column Field', 'danger');
        }
      });
    },
  }
})
</script>

<style scoped>

</style>

