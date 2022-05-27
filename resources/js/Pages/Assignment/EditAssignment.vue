<template>
  <app-layout title="Dashboard" pathImage="../../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Assignment Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submit()">
            <template #title>
              Assignment Information
            </template>

            <template #description>
              This Page Cotains Information About Workflow Route And Hierarchy Approval.
              You Can Make Your Own Hierarchy Approval. Contact Your System Administrator To Assist You.
            </template>


            <template #form>
              <!-- assignment_code -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_code" value="Assignment Code" :required="true"/>
                <jet-input id="assignment_code" type="text" class="mt-1 block w-full" v-model="form.assignment_code" disabled=""/>
                <jet-input-error :message="form.errors.assignment_code" class="mt-2" />
              </div>
              <!-- assignment_code At -->

              <!-- assignment_name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_name" value="Assignment Name" :required="true"/>
                <jet-input id="assignment_name" type="text" class="mt-1 block w-full" v-model="form.assignment_name" autocomplete="name" />
                <jet-input-error :message="form.errors.assignment_name" class="mt-2" />
              </div>
              <!-- assignment_name -->

              <!-- assignment_description -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_description" value="Assignment Description" :required="true"/>
                <textarea id="activiy" placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" v-model="form.assignment_description"></textarea>
                <jet-input-error :message="form.errors.assignment_description" class="mt-2" />
              </div>
              <!-- assignment_description -->

              <!-- isactive -->
              <div class="col-span-6 sm:col-span-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                <select id="status" name="status" v-model="form.isactive" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="option in options" :key="option.value" :value="option.value" :selected="option.value === form.isactive">{{option.text}}</option>
                </select>
                <jet-input-error :message="form.errors.isactive" class="mt-2" />
              </div>
              <!-- isactive -->

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
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignmen Description</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sequence</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Person</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(assigndetail,index) in form.rowData" :key="assigndetail.sequence">
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.assignment_description }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.status }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.sequence }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.assignmeto }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <jet-button type="button" @click="deleteAssignmentDetail(index)" class="mb-2 bg-red-500 hover:bg-red-600">
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
              <Link href="/assignment" class="">
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
            <!-- assignment_description -->
            <div class="mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
              <jet-label for="assignment_description" value="Assignment Description" class="text-lg" :required="true"/>
              <textarea id="assignment_description" v-model="formassignmentdetailobjt.assignment_description" class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="assignment_description" rows="3" cols="62"  ></textarea>
            </div>
            <!-- assignment_description -->

            <!-- sequence -->
            <div class="">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
              </svg>
              <jet-label for="sequence" value="Sequence Approval" class="text-lg" :required="true"/>
              <jet-input id="sequence" type="number" class="mt-1 block w-full" v-model="formassignmentdetailobjt.sequence"/>
            </div>
            <!-- sequence -->

            <!-- status -->
            <div class="mt-1">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
              </svg>
              <jet-label for="status" value="Status" class="text-lg" :required="true"/>
              <jet-input id="status" type="text" class="mt-1 block w-full" v-model="formassignmentdetailobjt.status" />
            </div>
            <!-- status -->

            <!-- assignmetoid -->
            <div class="mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
              <Listbox v-model="selectedassignmetoid" as="div">
                <ListboxLabel class="block text-lg">
                  <span>Assignmen Person <i class="text-xs text-red-600">*Required</i></span>
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

            <!-- assignment_description -->
            <div class="mt-2">
              <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
              </svg>
              <jet-label for="apprnote" value="Approval Note" class="text-lg"/>
              <textarea id="apprnote" v-model="formassignmentdetailobjt.apprnote" class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="apprnote" rows="3" cols="62"  ></textarea>
            </div>
            <!-- assignment_description -->


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
  name: "EditAssignment",
  props: ['listuser','assignment','assignmentdetail'],
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
        assignment_code: this.assignment.assignment_code,
        assignment_name: this.assignment.assignment_name,
        assignment_description: this.assignment.assignment_description,
        isactive: true,
        rowData: this.assignmentdetail,
      }),
      formassignmentdetailobjt: {
        assignment_code: '',
        assignment_description: '',
        sequence: '',
        status: '',
        assignmeto: '',
        assignmetoid: null,
        delegateto: '',
        delegatetoid: null,
        apprnote: ''
      },
      selectedassignmetoid: this.listuser[0],
      options: [
        { text: 'Active', value: true },
        { text: 'Non Active', value: false },
      ],
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
      if (this.formassignmentdetailobjt.assignment_description === null || this.formassignmentdetailobjt.assignment_description === '') {
        this.notif('Error Occured', 'Please Fill Assignment Description Field', 'danger');
        isExecute = false;
      }
      if (this.formassignmentdetailobjt.sequence === null || this.formassignmentdetailobjt.sequence === '') {
        this.notif('Error Occured', 'Please Fill Sequence Field', 'danger');
        isExecute = false;
      }
      if (this.formassignmentdetailobjt.status === null || this.formassignmentdetailobjt.status === '') {
        this.notif('Error Occured', 'Please Fill Status Field', 'danger');
        isExecute = false;
      }

      if (this.form.rowData.length > 0) {
        this.form.rowData.forEach(element => {
          if (element.sequence === this.formassignmentdetailobjt.sequence) {
            this.notif('Error Occured', 'Sequence Must Not Be Same', 'danger');
            isExecute = false;
          }
        });
      }

      if (isExecute) {
        let tempObjt = {};

        this.formassignmentdetailobjt.assignment_code = this.form.assignment_code;
        this.formassignmentdetailobjt.assignmeto = this.selectedassignmetoid.name;
        this.formassignmentdetailobjt.assignmetoid = this.selectedassignmetoid.id;

        tempObjt.assignment_code = this.formassignmentdetailobjt.assignment_code;
        tempObjt.assignment_description = this.formassignmentdetailobjt.assignment_description;
        tempObjt.sequence = this.formassignmentdetailobjt.sequence;
        tempObjt.status = this.formassignmentdetailobjt.status;
        tempObjt.assignmeto = this.formassignmentdetailobjt.assignmeto;
        tempObjt.assignmetoid = this.formassignmentdetailobjt.assignmetoid;
        tempObjt.delegateto = this.formassignmentdetailobjt.delegateto;
        tempObjt.delegatetoid = this.formassignmentdetailobjt.delegatetoid;
        tempObjt.apprnote = this.formassignmentdetailobjt.apprnote;

        this.form.rowData.push(tempObjt);
        this.form.rowData = this.form.rowData.sort(function(a,b){
          if (a.sequence < b.sequence) {
            return -1;
          }
          if (a.sequence > b.sequence) {
            return 1;
          }
          return 0;
        });
        //clear Data After Add.
        this.formassignmentdetailobjt.assignment_code = '';
        this.formassignmentdetailobjt.assignment_description = '';
        this.formassignmentdetailobjt.sequence = '';
        this.formassignmentdetailobjt.status = '';
        this.formassignmentdetailobjt.assignmeto = '';
        this.formassignmentdetailobjt.assignmetoid = null;
        this.formassignmentdetailobjt.delegateto = '';
        this.formassignmentdetailobjt.delegatetoid = null;
        this.formassignmentdetailobjt.apprnote = '';
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
      this.form.put('/assignment/'+this.assignment.id, {
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
