<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Delegation Of Authority Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submitdoa()">
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
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

              <!-- doacode -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <jet-label
                  for="applicantcode"
                  value="Doa Code"
                  class="font-semibold text-base"
                />
                <jet-input id="applicantcode" type="text" class="mt-2 block w-full" v-model="form.doacode" disabled/>
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

              <jet-input id="userid" type="hidden" v-model="form.user_id"/>

              <!-- Justification-->
              <div class="col-span-6 sm:col-span-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <jet-label for="justification" value="Justification" class="font-semibold text-base"/>
                <textarea
                  id="justification"
                  class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                  name="address"
                  rows="3"
                  cols="77"
                  v-model="form.justification"
                  :disabled="!form.isedit"
                ></textarea>
              </div>

              <!-- created_by -->
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

              <!-- Alias -->
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
                <Listbox v-model="selected" as="div" :disabled="!form.isedit">
                  <ListboxLabel class="block font-semibold text-base">
                    Alias Original
                  </ListboxLabel>
                  <div class="mt-1 relative">
                    <ListboxButton
                      class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                      <span class="flex items-center">
                        <img
                          :src="selected.profile_photo_url"
                          alt=""
                          class="flex-shrink-0 h-6 w-6 rounded-full"
                        />
                        <span class="ml-3 block truncate">
                          {{ selected.name + " - " + selected.posname }}
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
                          v-for="person in listAlias"
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

              <!-- Alias end -->

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
                <jet-input id="oridepartment" type="text" class="mt-1 block w-full" v-model="form.oridepartment" disabled/>
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
                <jet-input id="oriposition" type="text" class="mt-1 block w-full" v-model="form.oriposition" disabled/>
                <jet-input-error :message="form.errors.posname" class="mt-2" />
              </div>
              <!-- Posname -->

              <!-- Alias Acting -->
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
                <Listbox v-model="selectedActing" as="div" :disabled="!form.isedit">
                  <ListboxLabel class="block font-semibold text-base">
                    Alias Acting
                  </ListboxLabel>
                  <div class="mt-1 relative">
                    <ListboxButton
                      class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                      <span class="flex items-center">
                        <img
                          :src="selectedActing.profile_photo_url"
                          alt=""
                          class="flex-shrink-0 h-6 w-6 rounded-full"
                        />
                        <span class="ml-3 block truncate">
                          {{ selectedActing.name + " - " + selectedActing.posname }}
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
                          v-for="person in listAliasActing"
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

              <!-- Alias Acting end -->

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
                           v-model="form.start_date"
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
                           v-model="form.end_date"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    />
                  </div>
                </div>
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
              <Link :href="route('doa.index')" class="">
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
import {
  Listbox,
  ListboxButton,
  ListboxLabel,
  ListboxOption,
  ListboxOptions,
} from "@headlessui/vue";
import { CheckIcon, SelectorIcon } from "@heroicons/vue/solid";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css'

export default defineComponent( {
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
  props: ['users','department','position','assignment','codedoa'],
  data(){
    return{
      form: this.$inertia.form({
        justification: '',
        assignment_code: '',
        assignment_id: '',
        status: 'DRAFT',
        isedit: true,
        doacode: this.codedoa,
        oridepartment: '',
        oriposition: '',
        alias: '',
        alias_id: '',
        alias_acting: '',
        alias_acting_id: '',
        start_date: '',
        end_date: '',
        created_by: this.$page.props.user.name,
        is_active: false,
        attachment1: '',
        attachment2: '',
      }),
      selected:{
        id: "",
        profile_photo_url: "https://ui-avatars.com/api/?name=Not+Found&color=7F9CF5&background=EBF4FF",
        name: "Please Chose One",
        department: "",
        posname: ""
      },
      selectedActing:{
        id: "",
        profile_photo_url: "https://ui-avatars.com/api/?name=Not+Found&color=7F9CF5&background=EBF4FF",
        name: "Please Chose One",
        department: "",
        posname: ""
      },
      listAlias: this.users,
      listAliasActing: this.users

    }
  },
  watch:{
    selected(value){
      if(value.id === ''){
        this.form.oridepartment = '';
        this.form.oriposition = '';
      }else{
        this.form.oridepartment = value.department;
        this.form.oriposition = value.posname;
      }
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
    submitdoa(){
      this.form.alias_id = this.selected.id;
      this.form.alias = this.selected.name;
      this.form.alias_acting_id = this.selectedActing.id;
      this.form.alias_acting = this.selectedActing.name;
      if(this.form.alias_id === this.selectedActing.id){
        this.notif('Error Occured','Original User And The Acting User Are The Same User !!','danger');
      } else {
        if (this.form.assignment_id === '' || this.form.assignment_id === null){
          this.notif('Error Occured','Please Chosee At Least One Assignmnet !!','danger');
        } else {
          let objetAssignment = this.assignment.find(
            (u) => u.id === this.form.assignment_id
          );
          this.form.assignment_code = objetAssignment.assignment_code;
          this.form.post(route('doa.store'), {
            preserveScroll: false,
            onSuccess: () => {
              this.notif('Success',this.$page.props.flash.message.message,'success');
              this.form.isedit = false;
              this.form.status = this.$page.props.flash.message.status;
            },
            onError: () => {
              if (this.form.errors.doa){
                this.notif('Error Occured',this.form.errors.doa,'danger');
              } else {
                this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
              }
            }
          });
        }
      }
    }

  }
});
</script>

