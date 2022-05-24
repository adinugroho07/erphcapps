<template>
  <app-layout title="Dashboard" pathImage="../../../../image/logo.png">
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

              <!-- applicantcode -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                </svg>
                <jet-label
                  for="applicantcode"
                  value="Applicant Code"
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
                  :disabled="form.isedit === 1"
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

              <!-- assignperson -->
              <div class="col-span-1 sm:col-span-1 mt-3">
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
                  for="assignperson"
                  value="Assignment For"
                  class="font-semibold text-base"
                />
                <jet-input id="assignperson" type="text" class="mt-2 block w-full" v-model="compAssignperson" disabled/>
              </div>

              <!-- assignperson -->
              <div class="col-span-1 sm:col-span-1 mt-3">
                <jet-button type="button" @click.prevent="openModal" v-show="isAssignmentForLogin" class="bg-cyan-500 hover:bg-cyan-600">
                  Route
                </jet-button>
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
                  :disabled="form.isedit === 1"
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
                <Listbox v-model="selected" as="div" :disabled="form.isedit === 1">
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
                <Listbox v-model="selectedActing" as="div" :disabled="form.isedit === 1">
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
                           :disabled="form.isedit === 1"
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
                           :disabled="form.isedit === 1"
                           v-model="form.end_date"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    />
                  </div>
                </div>
              </div>

              <!-- attachment 1 -->
              <div class="col-span-6 sm:col-span-4">
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
                  for="attachment1"
                  value="Attachment 1"
                  class="font-semibold text-base"
                />
                <input
                  class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                  id="attachment1"
                  @input="form.attachment1 = $event.target.files[0]"
                  :disabled="form.isedit === 1"
                  type="file">
                <a target="_blank" v-show="form.attachment1" :href="form.attachment1" class="mt-2 block w-full disabled:opacity-75">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg> Open File
                </a>
                <jet-input-error :message="form.errors.attachment1" class="mt-2" />
              </div>

              <!-- attachment 2 -->
              <div class="col-span-6 sm:col-span-4">
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
                  for="attachment2"
                  value="Attachment 2"
                  class="font-semibold text-base"
                />
                <input class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                       id="attachment2"
                       @input="form.attachment2 = $event.target.files[0]"
                       :disabled="form.isedit === 1"
                       type="file">
                <a target="_blank" v-show="form.attachment2" :href="form.attachment2" class="mt-2 block w-full disabled:opacity-75">
                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                  </svg> Open File
                </a>
                <jet-input-error :message="form.errors.attachment2" class="mt-2" />
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Delegation Of Authority Status History
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <jet-label for="history" value="Document History" class="mb-1  font-semibold text-base"/>
                <div id="history" class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Change By</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Memo</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Updated At</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(history,index) in doahistory" :key="history.id">
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ history.status }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ history.changeby }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ history.memo }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ history.created_at }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ history.updated_at }} </span>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>

            </template>

            <template #actions>
              <Link :href="route('doa.index')" class="">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600 mr-2" >Back</jet-button>
              </Link>


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

            <!-- id transaksi applicant -->
            <jet-input id="id" type="hidden" v-model="modalValue.id" />

            <!-- id transaksi assignment -->
            <jet-input id="id" type="hidden" v-model="modalValue.assignment_id" />

            <!-- applicantcode -->
            <div class="">
              <jet-label for="applicantcode" value="Applicant Code" class="text-lg"/>
              <jet-input id="applicantcode" type="text" class="mt-1 block w-full" v-model="modalValue.applicantcode" disabled/>
            </div>

            <!-- status -->
            <div class="">
              <jet-label for="status" value="Status" class="text-lg"/>
              <jet-input id="status" type="text" class="mt-1 block w-full" v-model="modalValue.status" disabled/>
            </div>

            <!-- assignment_code -->
            <div class="">
              <jet-label for="assignment_code" value="Assignment Code" class="text-lg"/>
              <jet-input id="assignment_code" type="text" class="mt-1 block w-full" v-model="modalValue.assignment_code" disabled/>
            </div>

            <!-- memo -->
            <div class="mt-2">
              <jet-label for="memo" value="Memo Approval" class="text-lg"/>
              <textarea id="memo" class="mt-1 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="address" rows="3" cols="62" v-model="modalValue.memo" ></textarea>
            </div>

          </div>
        </form>
      </template>
      <template #footer>
        <div class="modal-footer flex flex-shrink-0 flex-wrap items-center justify-end p-4 border-t border-gray-200 rounded-b-md">
          <button @click="close" type="button" class="px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
            Close
          </button>
          <button @click="approve" type="button" class="ml-2 mr-2 px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
            Approve
          </button>
          <button @click="reject" type="button" class="px-6 py-2.5 overflow-auto bg-purple-600 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-purple-700 hover:shadow-lg focus:bg-purple-700 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-purple-800 active:shadow-lg transition duration-150 ease-in-out" data-bs-dismiss="modal">
            Reject
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
import {Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions} from "@headlessui/vue";
import {CheckIcon, SelectorIcon} from "@heroicons/vue/solid";
import { createToast } from 'mosha-vue-toastify';
import 'mosha-vue-toastify/dist/style.css';
import JetDialogModal from "@/Jetstream/DialogModal";

export default defineComponent({
  name: "ApprovalDoa",
  components: {
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
    JetDialogModal
  },
  props: ['users', 'doa', 'assignment', 'assignmentnow','doahistory'],
  data() {
    return {
      show: false,
      modalValue: this.$inertia.form({
        applicantcode: this.doa.doacode,
        status: this.doa.status,
        id: this.doa.id,
        assignment_id: this.doa.assignment_id,
        assignment_code: this.doa.assignment_code,
        memo: '',
        action: ''
      }),
      form: this.$inertia.form({
        justification: this.doa.justification,
        assignment_code: this.doa.assignment_code,
        assignment_id: this.doa.assignment_id,
        status: this.doa.status,
        isedit: this.doa.isedit,
        doacode: this.doa.doacode,
        oridepartment: this.doa.oridepartment,
        oriposition: this.doa.oriposition,
        alias: this.doa.alias,
        alias_id: this.doa.alias_id,
        alias_acting: this.doa.alias_acting,
        alias_acting_id: this.doa.alias_acting_id,
        start_date: this.doa.start_date,
        end_date: this.doa.end_date,
        created_by: this.doa.created_by,
        is_active: this.doa.is_active,
        attachment1: this.doa.attachment1,
        attachment2: this.doa.attachment2,
      }),
      selected: this.users.find((u) => u.id === this.doa.alias_id),
      selectedActing: this.users.find((u) => u.id === this.doa.alias_acting_id),
      listAlias: this.users,
      listAliasActing: this.users

    }
  },
  computed: {
    compAssignperson() {
      if (this.assignmentnow === null) {
        return 'There Is No Approval';
      } else {
        return this.assignmentnow.assignperson;
      }
    },
    isAssignmentForLogin(){
      if (this.assignmentnow === null){
        return false;
      } else {
        if (this.$page.props.user.id === this.assignmentnow.assignpersonid){
          return true;
        }
      }
      return false;
    },
  },
  watch: {
    selected(value) {
      if (value.id === '') {
        this.form.oridepartment = '';
        this.form.oriposition = '';
      } else {
        this.form.oridepartment = value.department;
        this.form.oriposition = value.posname;
      }
    }
  },
  methods:{
    openModal(){
      this.show = true;
    },
    close(){
      this.show = false;
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
    reject(){
      this.modalValue.action = 'REJECT';
      this.modalValue.post(route('doa.approve'), {
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message.message,'success');
          this.form.status = this.$page.props.flash.message.status;
          this.modalValue.reset('memo');
          this.modalValue.reset('action');
          this.close();
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      })
    },
    approve(){
      this.modalValue.action = 'APPROVE';
      this.modalValue.post(route('doa.approve'), {
        onSuccess: () => {
          console.log(this.$page.props);
          this.notif('Success',this.$page.props.flash.message.message,'success');
          this.form.status = this.$page.props.flash.message.status;
          this.modalValue.reset('memo');
          this.modalValue.reset('action');
          this.close();
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      })
    },
  }
})
</script>

<style scoped>

</style>

