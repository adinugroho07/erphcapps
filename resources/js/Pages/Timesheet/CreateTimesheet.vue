<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create TimeSheet
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form >
            <div class="border-b border-gray-200 dark:border-gray-700 mb-5">
              <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('personal')" :class="isActiveBasic">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>Personal Data
                  </a>
                </li>
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('attachment')" :class="isActiveRole">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>Attachment
                  </a>
                </li>
              </ul>
            </div>
            <div class="md:grid md:grid-cols-3 md:gap-1 ">
              <div class="md:col-span-1 flex justify-between ">
                <div class=" sm:px-0 ">
                  <h3 class="text-lg font-medium text-gray-900">
                    Document And Work Flow Information
                  </h3>
                  <div class="border-t border-gray-300"></div>

                  <div class="mt-1 text-sm text-gray-600">

                    <!-- status -->
                    <div class="col-span-1 sm:col-span-1 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label
                        for="status"
                        value="Status Document"
                        class="font-semibold text-base"
                        :required="true"
                      />
                      <jet-input id="status" type="text" class="mt-2 block w-full" v-model="form.status" disabled/>
                    </div>

                    <!-- timesheetcode -->
                    <div class="col-span-1 sm:col-span-1 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                      </svg>
                      <jet-label
                        for="timesheetcode"
                        value="Timesheet Code"
                        class="font-semibold text-base"
                        :required="true"
                      />
                      <jet-input id="timesheetcode" type="text" class="mt-2 block w-full" v-model="form.timesheetcode" disabled/>
                    </div>

                    <!-- assignment-->
                    <div class="col-span-1 sm:col-span-1 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                      </svg>
                      <jet-label for="assignment" value="Assignment" class="font-semibold text-base" :required="true"/>
                      <select
                        id="assignment"
                        name="assignment"
                        v-model="form.assignment_id"
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in assignment"
                          :key="option.id"
                          :value="option.id"
                          :disabled="form.isedit"
                        >
                          {{ option.assignment_code + " - " + option.assignment_name }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.assignment_id" class="mt-2" />
                    </div>


                  </div>
                </div>
              </div>

              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                  <!-- Personal data -->
                  <div v-show="personal" class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Timesheet Header
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
                        :required="true"
                      />
                      <jet-input id="name" type="text" :disabled="form.isedit" class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" />
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
                        :required="true"
                      />
                      <jet-input id="email" type="email" :disabled="form.isedit" class="mt-2 block w-full" v-model="form.email" />
                      <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>

                    <!-- periode-->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      <jet-label for="periode" value="Period" class="font-semibold text-base" :required="true"/>
                      <select
                        id="periode"
                        name="periode"
                        v-model="selectedperiod"
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsPeriod"
                          :key="option.value"
                          :value="option.value"
                          :disabled="form.isedit"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.periode" class="mt-2" />
                    </div>

                    <!-- description-->
                    <div class="col-span-6 sm:col-span-6" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                      </svg>
                      <jet-label for="description" value="Descriptions" class="font-semibold text-base" :required="true"/>
                      <textarea id="description" :disabled="form.isedit" v-model="form.description"  class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="address" rows="3" cols="77" ></textarea>
                      <jet-input-error :message="form.errors.description" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Timesheet Detail
                      </div>
                      <div class="border-t border-gray-300"></div>
                    </div>

                    <!-- Timesheet Detail  -->
                    <div class="col-span-6 sm:col-span-6">
                      <div id="history" class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200 ">
                          <thead class="bg-gray-50">
                          <tr>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span>Work Status<i class="text-xs text-red-600">*</i></span></th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span>Date<i class="text-xs text-red-600">*</i></span></th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span>Total Hours<i class="text-xs text-red-600">*</i></span></th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"><span>Present<i class="text-xs text-red-600">*</i></span></th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Work Location</th>
                            <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Remarks</th>
                          </tr>
                          </thead>
                          <tbody class="bg-white divide-y divide-gray-200">
                          <tr v-for="(timesheetdetail,index) in getInterval" :key="timesheetdetail">
                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Workstatus -->
                              <select
                                :id="'workstatus'+index"
                                :name="'workstatus'+index"
                                v-model="timesheetdetails[index].workstatus"
                                :disabled="form.isedit || timesheetdetails[index].disabled"
                                class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                              >
                                <option :value="true">ON</option>
                                <option :value="false">OFF</option>
                              </select>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Date -->
                              <jet-input :id="'tanggal'+index" disabled type="text" class="mt-2 block w-full disabled:opacity-75" v-model="timesheetdetails[index].tanggal" />
                            </td>

                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Total Hour -->
                              <jet-input :id="'totalhours'+index" :disabled="form.isedit || timesheetdetails[index].disabled"  type="number" class="mt-2 block w-full disabled:opacity-75" v-model="timesheetdetails[index].totalhours" />
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Present -->
                              <select
                                :id="'hadir'+index"
                                :name="'hadir'+index"
                                v-model="timesheetdetails[index].hadir"
                                :disabled="form.isedit || timesheetdetails[index].disabled"
                                class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                              >
                                <option :value="true" >Yes</option>
                                <option :value="false">No</option>
                              </select>
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Work Location -->
                              <jet-input :id="'worklocation'+index" :disabled="form.isedit || timesheetdetails[index].disabled" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="timesheetdetails[index].worklocation" />
                            </td>
                            <td class="px-3 py-4 whitespace-nowrap">
                              <!-- Remarks -->
                              <jet-input :id="'remarks'+index" :disabled="form.isedit || timesheetdetails[index].disabled" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="timesheetdetails[index].remarks" />
                            </td>
                          </tr>
                          </tbody>
                        </table>
                      </div>
                      <jet-input-error :message="form.errors.timesheetdetailsfix" class="mt-2" />
                    </div>
                    <!-- Assignment Detail -->

                  </div>
                  <!-- Personal data -->

                  <!-- Attachment data -->
                  <div v-show="attachment" class="grid grid-cols-6 gap-6">
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
                        :disabled="form.isedit"
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
                             :disabled="form.isedit"
                             type="file">
                      <jet-input-error :message="form.errors.attachment2" class="mt-2" />
                    </div>

                    <!-- attachment 3 -->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                      </svg>
                      <jet-label
                        for="attachment3"
                        value="Attachment 3"
                        class="font-semibold text-base"
                      />
                      <input class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                             id="attachment3"
                             @input="form.attachment3 = $event.target.files[0]"
                             :disabled="form.isedit"
                             type="file">
                      <jet-input-error :message="form.errors.attachment3" class="mt-2" />
                    </div>

                    <!-- attachment 4 -->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" />
                      </svg>
                      <jet-label
                        for="attachment4"
                        value="Attachment 4"
                        class="font-semibold text-base"
                      />
                      <input class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                             id="attachment4"
                             @input="form.attachment4 = $event.target.files[0]"
                             :disabled="form.isedit"
                             type="file">
                      <jet-input-error :message="form.errors.attachment4" class="mt-2" />
                    </div>

                  </div>
                  <!-- Attachment data -->
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                  <Link href="/applicant" class="float-left">
                    <jet-button class="bg-cyan-500 hover:bg-cyan-600"
                    >Back</jet-button
                    >
                  </Link>
                  <jet-button
                    class="ml-2 bg-cyan-500 hover:bg-cyan-600 object-left"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="button"
                    v-show="form.status === 'DRAFT'"
                    @click.prevent = "hold"
                  >
                    Hold
                  </jet-button>
                  <jet-button
                    class="ml-2 bg-cyan-500 hover:bg-cyan-600 object-left"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="button"
                    v-show="form.status === 'DRAFT' || form.status === 'HOLD'"
                    @click.prevent = "submit"
                  >
                    Save And Route
                  </jet-button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout"
import JetActionMessage from "@/Jetstream/ActionMessage"
import JetButton from "@/Jetstream/Button"
import JetFormSection from "@/Jetstream/FormSection"
import JetInput from "@/Jetstream/Input"
import JetInputError from "@/Jetstream/InputError"
import JetLabel from "@/Jetstream/Label"
import JetSecondaryButton from "@/Jetstream/SecondaryButton"
import {Link} from "@inertiajs/inertia-vue3"
import {defineComponent} from "vue";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'
import { DateTime,Info  } from "luxon";

export default defineComponent({
  name: "CreateTimesheet",
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
    JetFormSection,
    JetInput,
    JetInputError,
    JetLabel,
    JetSecondaryButton,
    Link,
  },
  props:['assignment','codetimesheet'],
  data(){
    return{
      form: this.$inertia.form({
        status : 'DRAFT',
        timesheetcode : this.codetimesheet,
        assignment_id : '',
        assignment_code : '',
        createdby : this.$page.props.user.name,
        createdbyid : this.$page.props.user.id,
        year : DateTime.local().year,
        isedit : false,
        action : '',
        name : this.$page.props.user.name,
        email : this.$page.props.user.email,
        description : '',
        periode : '',
        attachment1 : '',
        attachment2 : '',
        attachment3 : '',
        attachment4 : '',
        timesheetdetailsfix: []
      }),
      timesheetdetails:[],
      selectedperiod: '',
      optionsPeriod: [
        { text: "January - "+DateTime.local().year, value: "1" },
        { text: "February - "+DateTime.local().year, value: "2" },
        { text: "Maret - "+DateTime.local().year, value: "3" },
        { text: "April - "+DateTime.local().year, value: "4" },
        { text: "Mei - "+DateTime.local().year, value: "5" },
        { text: "Juni - "+DateTime.local().year, value: "6" },
        { text: "Jully - "+DateTime.local().year, value: "7" },
        { text: "Agustus - "+DateTime.local().year, value: "8" },
        { text: "September - "+DateTime.local().year, value: "9" },
        { text: "October - "+DateTime.local().year, value: "10" },
        { text: "November - "+DateTime.local().year, value: "11" },
        { text: "Desember - "+DateTime.local().year, value: "12" },
      ],
      personal: true,
      attachment:false,
      active: 'inline-flex py-4 px-4 text-sm font-medium text-center text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group',
      nonactive: 'inline-flex py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 group'
    }
  },
  computed:{
    isActiveBasic(){
      if(this.personal){
        return this.active;
      }
      return this.nonactive;
    },
    isActiveRole(){
      if(this.attachment){
        return this.active;
      }
      return this.nonactive;
    },
    getInterval(){
      const year = DateTime.local().year;

      if(this.selectedperiod !== ''){
        const lastdayofmonth = DateTime.local(year,Number(this.selectedperiod)).endOf('month').day;
        //DateTime.local(year,this.form.periode,step).toString()

        if (this.timesheetdetails.length !== 0){
          this.timesheetdetails.splice(0,this.timesheetdetails.length);
        }

        for (let step = 1; step <= lastdayofmonth; step++){
          let tempObjt = {}
          if(
            DateTime.local(year,Number(this.selectedperiod),step).weekdayShort === 'Sat' ||
            DateTime.local(year,Number(this.selectedperiod),step).weekdayShort === 'Sun'
          ){
            //hari libur
            tempObjt = {
              timesheet_id: '',
              workstatus: false,
              tanggal: DateTime.local(year,Number(this.selectedperiod),step).toLocaleString(),
              totalhours: 0,
              hadir: false,
              worklocation: '',
              disabled: true,
              remarks: 'Weekend',
            };
          } else {
            tempObjt = {
              timesheet_id: '',
              workstatus: true,
              tanggal: DateTime.local(year,Number(this.selectedperiod),step).toLocaleString(),
              totalhours: '',
              hadir: true,
              worklocation: '',
              disabled: false,
              remarks: '',
            };
          }


          this.timesheetdetails.push(tempObjt);

        }
      }


      return this.timesheetdetails;
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
    hold(){
      this.form.timesheetdetailsfix = this.timesheetdetails;
      if(this.checkIfTotalHourNull()){
        return this.notif('Error Occured','Total Hours Cannot Be Null, Please Give Value At Least 0 !!','danger');
      };
      //fill assignment id
      if (this.form.assignment_id !== ''){
        let objetAssignment = this.assignment.find(
          (u) => u.id === this.form.assignment_id
        );
        this.form.assignment_code = objetAssignment.assignment_code;
      } else {
        this.form.assignment_code = '';
      }

      this.form.status = 'HOLD';
      this.form.action = 'HOLD';
      this.form.periode = this.selectedperiod;

      this.form.post(route('timesheet.store'), {
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message,'success');
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      })
    },
    submit(){
      this.form.timesheetdetailsfix = this.timesheetdetails;
      if(this.checkIfTotalHourNull()){
          return this.notif('Error Occured','Total Hours Cannot Be Null, Please Give Value At Least 0 !!','danger');
      };
      //fill assignment id
      if (this.form.assignment_id !== ''){
        let objetAssignment = this.assignment.find(
          (u) => u.id === this.form.assignment_id
        );
        this.form.assignment_code = objetAssignment.assignment_code;
      } else {
        this.form.assignment_code = '';
      }

      this.form.status = 'DRAFT';
      this.form.action = 'ROUTE';
      this.form.periode = this.selectedperiod;

      this.form.post(route('timesheet.store'), {
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message,'success');
          console.log(this.$page.props);
          this.form.isedit = true;
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      })
    },
    toggle(action){

      if (action === 'personal'){
        this.personal = true;
        this.attachment = false;
      }

      if (action === 'attachment'){
        this.personal = false;
        this.attachment = true;
      }
    },
    checkIfTotalHourNull(){
      let isTrue = false;
      this.timesheetdetails.forEach(element => {
        if(element.totalhours === ''){
          isTrue = true;
        }
      });
      return isTrue;
    }

  }
})
</script>

<style scoped>

</style>
