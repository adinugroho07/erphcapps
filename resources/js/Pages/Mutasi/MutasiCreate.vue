<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Transfer Job Form Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submitresign()">
            <template #title>
              Resign Information
            </template>

            <template #description>
              make sure the data entered is correct and make sure the selected assignment is correct.
            </template>

            <template #route>
              <!-- status -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label
                  for="status"
                  value="Status Document"
                  class="font-semibold text-base"
                />
                <jet-input id="status" type="text" class="mt-2 block w-full" v-model="form.status" disabled/>
              </div>

              <!-- codemutasi -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <jet-label
                  for="codemutasi"
                  value="Transfer Job Code"
                  class="font-semibold text-base"
                />
                <jet-input id="codemutasi" type="text" class="mt-2 block w-full" v-model="form.mutasicode" disabled/>
              </div>

              <!-- assignment-->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
                <jet-label for="assignment" value="Assignment" class="font-semibold text-base"/>
                <select
                  id="assignment"
                  name="assignment"
                  v-model="form.assignment_id"
                  :disabled="!form.isedit"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option disabled value="">Please select one</option>
                  <option
                    v-for="option in assignment"
                    :key="option.id"
                    :value="option.id"
                  >
                    {{ option.assignment_code + " - " + option.assignment_name }}
                  </option>
                </select>
                <jet-input-error :message="form.errors.assignment_id" class="mt-2" />
              </div>
            </template>


            <template #form>

              <!-- description-->
              <div class="col-span-6 sm:col-span-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <jet-label for="description" value="Description" class="font-semibold text-base"/>
                <textarea
                  id="description"
                  class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                  name="address"
                  rows="3"
                  cols="77"
                  v-model="form.description"
                  :disabled="!form.isedit"
                ></textarea>
              </div>

              <!-- created_by -->
              <div class="col-span-3 sm:col-span-4">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <jet-label
                  for="created_by"
                  value="Created By"
                  class="font-semibold text-base"
                />
                <jet-input id="created_by" type="text" class="mt-1 block w-full" v-model="form.created_by" disabled/>
                <jet-input-error :message="form.errors.created_by" class="mt-2" />
              </div>
              <!-- created_by -->

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Transfer Job From
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- Alias From -->
              <div class="col-span-6 sm:col-span-5">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                  />
                </svg>
                <Listbox v-model="selectedfrom" as="div" :disabled="!form.isedit">
                  <ListboxLabel class="block font-semibold text-base">
                    User To Be Transfered
                  </ListboxLabel>
                  <div class="mt-1 relative">
                    <ListboxButton
                      class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                      <span class="flex items-center">
                        <img
                          :src="selectedfrom.profile_photo_url"
                          alt=""
                          class="flex-shrink-0 h-6 w-6 rounded-full"
                        />
                        <span class="ml-3 block truncate">
                          {{ selectedfrom.name + " - " + selectedfrom.posname }}
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
                          v-for="person in users"
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

              <!-- Alias From end -->

              <!-- Department -->
              <div class="col-span-3 sm:col-span-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                  />
                </svg>
                <jet-label
                  for="department"
                  value="Original Department"
                  class="font-semibold text-base"
                />
                <jet-input id="oridepartment" type="text" class="mt-1 block w-full" v-model="form.department" disabled/>
                <jet-input-error :message="form.errors.department" class="mt-2" />
              </div>
              <!-- Department -->

              <!-- Posname -->
              <div class="col-span-3 sm:col-span-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                  />
                </svg>
                <jet-label
                  for="posname"
                  value="Original Position"
                  class="font-semibold text-base"
                />
                <jet-input id="oriposition" type="text" class="mt-1 block w-full" v-model="form.posname" disabled/>
                <jet-input-error :message="form.errors.posname" class="mt-2" />
              </div>
              <!-- Posname -->


              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Transfer Job To
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- Department -->
              <div class="col-span-6 sm:col-span-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"
                  />
                </svg>
                <jet-label
                  for="department"
                  value="Department"
                  class="font-semibold text-base"
                />
                <select
                  id="department"
                  name="department"
                  v-model="form.department_destination"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in department"
                    :key="option.org_code"
                    :value="option.org_name"
                    :disabled="!form.isedit"
                  >
                    {{ option.org_name }}
                  </option>
                </select>
              </div>

              <!-- Posname -->
              <div class="col-span-6 sm:col-span-3">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                  fill="none"
                  viewBox="0 0 24 24"
                  stroke="currentColor"
                  stroke-width="2"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"
                  />
                </svg>
                <jet-label
                  for="posname"
                  value="Position"
                  class="font-semibold text-base"
                />
                <select
                  id="posname"
                  name="posname"
                  v-model="form.posname_destination"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in selectionPosition"
                    :selected="form.poscode_destination === option.position_code"
                    :key="option.position_code"
                    :value="option.position_title"
                    :disabled="!form.isedit"
                  >
                    {{ option.position_title }}
                  </option>
                </select>
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Attachment
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- attachment 1 -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                <jet-label
                  for="attachment1"
                  value="Attachment 1"
                  class="font-semibold text-base"
                />
                <input
                  class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="attachment1"
                  @input="form.attachment1 = $event.target.files[0]"
                  :disabled="!form.isedit"
                  type="file">
                <jet-input-error :message="form.errors.attachment1" class="mt-2" />
              </div>

              <!-- attachment 2 -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                </svg>
                <jet-label
                  for="attachment2"
                  value="Attachment 2"
                  class="font-semibold text-base"
                />
                <input class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       id="attachment2"
                       @input="form.attachment2 = $event.target.files[0]"
                       :disabled="!form.isedit"
                       type="file">
                <jet-input-error :message="form.errors.attachment2" class="mt-2" />
              </div>

            </template>

            <template #actions>
              <Link :href="route('mutasi.index')" class="">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600 mr-2" >Back</jet-button>
              </Link>

              <jet-button  class="bg-cyan-500 hover:bg-cyan-600 object-left" :class="{ 'opacity-25': form.processing }" :disabled="form.processing || !form.isedit">
                Submit
              </jet-button>
            </template>
          </jet-form-section>
        </div>
      </div>
    </div>
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
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";


export default defineComponent({
  name: "MutasiCreate",
  components:{
    AppLayout,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetActionMessage,
    JetButton,
    Link,
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props: ['codemutasi','assignment','users','department','position'],
  data(){
    return{
      form: this.$inertia.form({
        assignment_code: '',
        assignment_id: '',
        status: 'DRAFT',
        mutasicode: this.codemutasi,
        isedit: true,
        department: '',
        department_code: '',
        posname: '',
        poscode: '',
        username: '',
        userid: '',
        department_destination: '',
        department_code_destination: '',
        posname_destination: '',
        poscode_destination: '',
        description: '',
        created_by: this.$page.props.user.name,
        created_byid: this.$page.props.user.id,
        attachment1: '',
        attachment2: '',
      }),
      selectedfrom: this.users[0],
    }
  },
  watch:{
    selectedfrom(value){
      if(value.id === ''){
        this.form.department = '';
        this.form.department_code = '';
        this.form.posname = '';
        this.form.poscode = '';
        this.form.username = '';
        this.form.userid = '';
      }else{
        this.form.department = value.department;
        this.form.department_code = value.department_code;
        this.form.posname = value.posname;
        this.form.poscode = value.poscode;
        this.form.username = value.name;
        this.form.userid = value.id;
      }
    }
  },
  computed:{
    selectionPosition() {
      let tempObj = {};
      if (this.form.department_destination === ''){
        tempObj = {
          org_code: '',
          org_name: ''
        }
      } else {
        tempObj = this.position.find(
          (u) => u.org_name === this.form.department_destination
        );
      }
      return this.position.filter((x) => x.org_code === tempObj.org_code);
    },
  },
  methods:{
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
    submitresign(){
      if (this.form.assignment_id === '' || this.form.assignment_id === null){
        this.notif('Error Occured','Please Chosee At Least One Assignmnet !!','danger');
      } else {
        if (this.form.userid === this.form.userid_destination){
          return this.notif('Error Occured','User From And Destination Are The Same Person !!','danger');
        }

        let objetAssignment = this.assignment.find(
          (u) => u.id === this.form.assignment_id
        );
        this.form.assignment_code = objetAssignment.assignment_code;

        let objtDept = this.department.find(
          (u) => u.org_name === this.form.department_destination
        );
        let objetPos = this.position.find(
          (u) => u.position_title === this.form.posname_destination
        );
        this.form.department_code_destination = objtDept.org_code;
        this.form.poscode_destination = objetPos.position_code;

        console.log(this.form);
        this.form.post(route('mutasi.store'), {
          preserveScroll: false,
          onSuccess: () => {
            this.notif('Success',this.$page.props.flash.message.message,'success');
            this.form.isedit = false;
            this.form.status = this.$page.props.flash.message.status;
          },
          onError: () => {
            console.log(this.form.errors);
            this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
          }
        });
      }
    }

  }
})
</script>

<style scoped>

</style>

