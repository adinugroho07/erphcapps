<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Paid Leave Create Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submitcuti()">
            <template #title>
              Leave Information
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

              <!-- cuticode -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <jet-label
                  for="applicantcode"
                  value="Leave Code"
                  class="font-semibold text-base"
                />
                <jet-input id="applicantcode" type="text" class="mt-2 block w-full" v-model="form.cuticode" disabled/>
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

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Leave Point
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- cutitahunan -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                </svg>
                <jet-label
                  for="cutitahunan"
                  value="Annual Leave"
                  class="font-semibold text-base"
                />
                <jet-input id="cutitahunan" type="text"  class="mt-2 block w-full disabled:opacity-75" v-model="jatahcuti.cutitahunan" autocomplete="name" disabled/>
              </div>

              <!-- cutimelahirkan -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                </svg>
                <jet-label
                  for="cutimelahirkan"
                  value="Maternity Leave"
                  class="font-semibold text-base"
                />
                <jet-input id="email" type="email"  class="mt-2 block w-full" v-model="jatahcuti.cutimelahirkan" disabled/>
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Data Leave
                </div>
                <div class="border-t border-gray-300"></div>
              </div>
              <!-- Name -->
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
                    d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                  />
                </svg>
                <jet-label
                  for="name"
                  value="Name"
                  class="font-semibold text-base"
                />
                <jet-input id="name" type="text"  class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" disabled/>
                <jet-input-error :message="form.errors.name" class="mt-2" />
              </div>

              <!-- Email -->
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
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
                <jet-label
                  for="email"
                  value="Email"
                  class="font-semibold text-base"
                />
                <jet-input id="email" type="email"  class="mt-2 block w-full" v-model="form.email" disabled/>
                <jet-input-error :message="form.errors.email" class="mt-2" />
              </div>

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

              <!-- Nik -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <jet-label for="nik" value="Nik" class="font-semibold text-base"/>
                <jet-input id="nik" :disabled="!form.isedit" type="text" class="mt-2 block w-full" v-model="form.nik" />
              </div>

              <!-- Justification-->
              <div class="col-span-6 sm:col-span-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4" />
                </svg>
                <jet-label for="justification" value="Justification" class="font-semibold text-base"/>
                <textarea
                  id="justification"
                  class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                  name="address"
                  rows="3"
                  cols="77"
                  v-model="form.description"
                  :disabled="!form.isedit"
                ></textarea>
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Period Leave
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- optionsTypeCuti-->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <jet-label for="optionsTypeCuti" value="Leave Type" class="font-semibold text-base"/>
                <select
                  id="optionsTypeCuti"
                  name="typecuti"
                  v-model="form.typecuti"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option disabled value="">Please select one</option>
                  <option
                    v-for="option in optionsTypeCuti"
                    :key="option.value"
                    :value="option.value"
                    :disabled="!form.isedit"
                  >
                    {{ option.text }}
                  </option>
                </select>
                <jet-input-error :message="form.errors.periode" class="mt-2" />
              </div>

              <!-- Start Date-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="start_date" value="Start Date" class="font-semibold text-base"/>
                <div class="mt-2 flex items-center justify-center">
                  <div class="datepicker relative form-floating xl:w-96" data-mdb-toggle-button="false">
                    <input type="date"
                           id="start_date"
                           :disabled="!form.isedit"
                           v-model="form.startdate"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    />

                  </div>
                </div>
              </div>

              <!-- end date-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="end_date" value="End Date" class="font-semibold text-base"/>
                <div class="mt-2 flex items-center justify-center">
                  <div class="datepicker relative form-floating xl:w-96" data-mdb-toggle-button="false">
                    <input type="date"
                           id="end_date"
                           :disabled="!form.isedit"
                           v-model="form.enddate"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    />
                  </div>
                </div>
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
              <Link :href="route('cuti.index')" class="">
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


export default defineComponent({
  name: "CutiCreate",
  components:{
    AppLayout,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetActionMessage,
    JetButton,
    Link,
  },
  props: ['codecuti','assignment','jatahcuti'],
  data(){
    return{
      form: this.$inertia.form({
        assignment_code: '' ,
        assignment_id: '' ,
        status: 'DRAFT' ,
        cuticode: this.codecuti ,
        isedit: true ,
        department: this.$page.props.user.department ,
        department_code: this.$page.props.user.department_code ,
        posname: this.$page.props.user.posname ,
        poscode: this.$page.props.user.poscode ,
        name: this.$page.props.user.name ,
        email: this.$page.props.user.email ,
        description: '' ,
        nik: this.$page.props.user.nik ,
        typecuti: '' ,
        startdate: '' ,
        enddate: '' ,
        created_by: this.$page.props.user.name ,
        created_byid: this.$page.props.user.id ,
        attachment1: '' ,
        attachment2: '' ,
      }),
      optionsTypeCuti: [
        { text: "Annual Leave", value: "CUTITAHUNAN" },
        { text: "Maternity Leave", value: "CUTIMELAHIRKAN" },
      ]
    }
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
    submitcuti(){
      if (this.form.assignment_id === '' || this.form.assignment_id === null){
        this.notif('Error Occured','Please Chosee At Least One Assignmnet !!','danger');
      } else {
        let objetAssignment = this.assignment.find(
          (u) => u.id === this.form.assignment_id
        );
        this.form.assignment_code = objetAssignment.assignment_code;
        console.log(this.form);
        this.form.post(route('cuti.store'), {
          preserveScroll: false,
          onSuccess: () => {
            this.notif('Success',this.$page.props.flash.message.message,'success');
            this.form.isedit = false;
            this.form.status = this.$page.props.flash.message.status;
          },
          onError: () => {
            console.log(this.form.errors);
            if (this.form.errors.cuti){
              this.notif('Error Occured',this.form.errors.cuti,'danger');
            } else {
              this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
            }
          }
        });
      }
    }

  }
})
</script>

<style scoped>

</style>
