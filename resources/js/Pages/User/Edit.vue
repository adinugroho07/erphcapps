<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pegawai Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section @submit.prevent="submit()">
            <template #title> Profile Information </template>

            <template #description>
              This Is Profile Page That Contains All Employee Information Data.
              Be Carefull To Update Employee Data. Contact Your System Administrator To Assist You.
            </template>

            <!--detail -->
            <template #form>
              <div class="col-span-6 sm:col-span-6">
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Personel Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>
              <!-- Name -->
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
                  for="named1"
                  value="Name"
                  class="font-semibold text-base"
                />
                <jet-input
                  id="named1"
                  type="text"
                  class="mt-1 block w-full disabled:opacity-75"
                  v-model="form.name"
                  autocomplete="name"
                />
              </div>

              <!-- Email -->
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
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
                <jet-label
                  for="emaild1"
                  value="Email"
                  class="font-semibold text-base"
                />
                <jet-input
                  id="emaild1"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="form.email"
                />
              </div>

              <!-- Nik -->
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
                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                  />
                </svg>
                <jet-label
                  for="nik"
                  value="Nik"
                  class="font-semibold text-base"
                />
                <jet-input
                  id="nik"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.nik"
                />
              </div>

              <!-- Status -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <label
                  for="status"
                  class="font-semibold text-base"
                >Status Account</label
                >
                <select
                  id="status"
                  name="status"
                  v-model="form.status"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in options"
                    :selected="form.status === option.value"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>
              </div>

              <!-- posstatus-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <jet-label for="posstatus" value="Status Pegawai" class="font-semibold text-base"/>
                <select
                  id="posstatus"
                  name="department"
                  v-model="form.posstatus"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in optionsStatusPegawai"
                    :selected="form.posstatus === option.value"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>
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
                  v-model="form.department"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in department"
                    :selected="form.department_code === option.org_code"
                    :key="option.org_code"
                    :value="option.org_name"
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
                  v-model="form.posname"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in selectionPosition"
                    :selected="form.poscode === option.position_code"
                    :key="option.position_code"
                    :value="option.position_title"
                  >
                    {{ option.position_title }}
                  </option>
                </select>
              </div>

              <!-- Supervisor -->
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
                <Listbox v-model="selected" as="div">
                  <ListboxLabel class="block font-semibold text-base">
                    Supervisor
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
                          v-for="person in managerUp"
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

              <!-- Supervisor end -->

              <!-- Supervisor posname-->
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
                  for="supervisor_posname"
                  value="Supervisor Position"
                  class="font-semibold text-base"
                />
                <jet-input
                  id="supervisor_posname"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.suppervisor_posname"
                  disabled
                />
              </div>

              <!-- expiredcontractdate-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label
                  for="expiredcontractdate"
                  value="Expired Contract Pegawai"
                  class="font-semibold text-base"
                />
                <jet-input id="expiredcontractdate" v-show="form.posstatus === 'pekerja'" type="text" class="mt-1 block w-full" value="Does Not Have An Expiration Date" disabled />
                <jet-input id="expiredcontractdate" v-show="form.posstatus === 'mitra'" type="date" class="mt-1 block w-full" v-model="form.expiredcontractdate" />
              </div>

              <!-- birthdate-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="birthdate" value="Birthdate" class="font-semibold text-base"/>
                <div class="mt-2 flex items-center justify-center">
                  <div class="datepicker relative form-floating xl:w-96" data-mdb-toggle-button="false">
                    <input type="text"
                           id="birthdate"
                           v-model="form.birthdate"
                           class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                           placeholder="Select a date" data-mdb-toggle="datepicker" />
                  </div>
                </div>
              </div>

              <!-- sex-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <jet-label for="sex" value="Gender" class="font-semibold text-base"/>
                <select
                  id="sex"
                  name="department"
                  v-model="form.sex"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in optionsGender"
                    :selected="form.sex === option.value"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>
              </div>

              <!-- religion-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                <jet-label for="religion" value="Religion" class="font-semibold text-base"/>
                <select
                  id="religion"
                  name="department"
                  v-model="form.religion"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in optionsReligion"
                    :selected="form.religion === option.value"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>
              </div>

              <!-- backtoback-->
              <div class="col-span-6 sm:col-span-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <Listbox v-model="selectedb2b" as="div">
                  <ListboxLabel class="block font-semibold text-base">
                    Back To Back
                  </ListboxLabel>
                  <div class="mt-1 relative">
                    <ListboxButton
                      class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                    >
                      <span class="flex items-center">
                        <img
                          :src="selectedb2b.profile_photo_url"
                          alt=""
                          class="flex-shrink-0 h-6 w-6 rounded-full"
                        />
                        <span class="ml-3 block truncate">
                          {{ selectedb2b.name + " - " + selectedb2b.posname }}
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
                          v-for="person in listUser"
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

              <div class="col-span-6 sm:col-span-6">
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Family Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- married-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                </svg>
                <jet-label for="married" value="Married" class="font-semibold text-base"/>
                <select
                  id="married"
                  name="married"
                  v-model="form.married"
                  class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                >
                  <option
                    v-for="option in optionsMarried"
                    :selected="form.married === option.value"
                    :key="option.value"
                    :value="option.value"
                  >
                    {{ option.text }}
                  </option>
                </select>
              </div>

              <!-- spouse-->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <jet-label for="spouse" value="Istri" class="font-semibold text-base"/>
                <jet-input
                  id="spouse"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.spouse"
                />
              </div>

              <!-- child1-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child1" value="Anak Pertama" class="font-semibold text-base"/>
                <jet-input
                  id="child1"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.child1"
                />
              </div>

              <!-- child2-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child2" value="Anak Kedua" class="font-semibold text-base"/>
                <jet-input
                  id="child2"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.child2"
                />
              </div>

              <!-- child3-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child3" value="Anak Ketiga" class="font-semibold text-base"/>
                <jet-input
                  id="child3"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.child3"
                />
              </div>

              <div class="col-span-6 sm:col-span-6">
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Place Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- state-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <jet-label for="state" value="Provinsi" class="font-semibold text-base"/>
                <jet-input
                  id="state"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.state"
                />
              </div>

              <!-- city-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <jet-label for="city" value="Kota" class="font-semibold text-base"/>
                <jet-input
                  id="city"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.city"
                />
              </div>

              <!-- postalcode-->
              <div class="col-span-2 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                </svg>
                <jet-label for="postalcode" value="Kode Pos" class="font-semibold text-base"/>
                <jet-input
                  id="postalcode"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.postalcode"
                />
              </div>

              <!-- address-->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <jet-label for="address" value="Alamat" class="font-semibold text-base"/>
                <textarea
                  id="address"
                  class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                  name="address"
                  rows="3"
                  cols="77"
                  v-model="form.address"
                ></textarea>
              </div>

              <div class="col-span-6 sm:col-span-6">
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Others Employee Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- bank-->
              <div class="col-span-3 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <jet-label for="bank" value="Bank Name" class="font-semibold text-base"/>
                <jet-input
                  id="bank"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.bank"
                />
              </div>

              <!-- bankkey-->
              <div class="col-span-3 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="bankkey" value="Bank Number" class="font-semibold text-base"/>
                <jet-input
                  id="bankkey"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.bankkey"
                />
              </div>

              <!-- phonenum-->
              <div class="col-span-3 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <jet-label for="phonenum" value="Nomor Handphone" class="font-semibold text-base"/>
                <jet-input
                  id="phonenum"
                  type="text"
                  class="mt-2 block w-full"
                  v-model="form.phonenum"
                />
              </div>
            </template>
            <!--detail -->

            <template #actions>
              <Link href="/pegawai" class="float-left">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600"
                >Back</jet-button
                >
              </Link>
              <jet-button
                class="ml-2 bg-cyan-500 hover:bg-cyan-600 object-left"
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
              >
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
import AppLayout from "@/Layouts/AppLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
import JetFormSection from "@/Jetstream/FormSection";
import JetInput from "@/Jetstream/Input";
import JetInputError from "@/Jetstream/InputError";
import JetLabel from "@/Jetstream/Label";
import JetSecondaryButton from "@/Jetstream/SecondaryButton";
import { Link } from "@inertiajs/inertia-vue3";
import { defineComponent } from "vue";
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

export default defineComponent({
  name: "PegawaiEdit",
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
    Listbox,
    ListboxButton,
    ListboxLabel,
    ListboxOption,
    ListboxOptions,
    CheckIcon,
    SelectorIcon,
  },
  props: ["userdetail", "userManager", "department", "position", "users"],
  data() {
    return {
      form: this.$inertia.form({
        id: this.userdetail.id,
        name: this.userdetail.name,
        email: this.userdetail.email,
        nik: this.userdetail.nik,
        profile_photo_path: this.userdetail.profile_photo_path,
        profile_photo_url: this.userdetail.profile_photo_url,
        department: this.userdetail.department,
        position_category: this.userdetail.position_category,
        posname: this.userdetail.posname,
        status: this.userdetail.status,
        createdat: this.userdetail.created_at,
        updatedat: this.userdetail.updated_at,
        suppervisor: this.userdetail.suppervisor,
        suppervisor_posname: this.userdetail.suppervisor_posname,
        suppervisor_id: this.userdetail.suppervisor_id,
        department_code: this.userdetail.department_code,
        poscode: this.userdetail.poscode,
        expiredcontractdate: this.userdetail.expiredcontractdate,
        posstatus: this.userdetail.posstatus,
        sex: this.userdetail.sex,
        birthdate: this.userdetail.birthdate,
        religion: this.userdetail.religion,
        spouse: this.userdetail.spouse,
        child1: this.userdetail.child1,
        child2: this.userdetail.child2,
        child3: this.userdetail.child3,
        married: this.userdetail.married,
        state: this.userdetail.state,
        city: this.userdetail.city,
        phonenum: this.userdetail.phonenum,
        postalcode: this.userdetail.postalcode,
        address: this.userdetail.address,
        bank: this.userdetail.bank,
        bankkey: this.userdetail.bankkey,
        backtoback_id: this.userdetail.backtoback_id,
        backtoback: this.userdetail.backtoback,
      }),
      options: [
        { text: "Active", value: "active" },
        { text: "Non Active", value: "nonactive" },
      ],
      optionsStatusPegawai: [
        { text: "Pekerja", value: "pekerja" },
        { text: "Mitra Kerja", value: "mitra" },
      ],
      optionsGender: [
        { text: "Male", value: "male" },
        { text: "Female", value: "female" },
      ],
      optionsMarried: [
        { text: "Married", value: 1 },
        { text: "Single", value: 0 },
      ],
      optionsReligion: [
        { text: "Islam", value: "islam" },
        { text: "Kristen Protestan", value: "protestan" },
        { text: "Kristen Khatolik", value: "khatolik" },
        { text: "Hindu", value: "hindu" },
        { text: "Budha", value: "budha" },
        { text: "Konghucu", value: "konghucu" },
        { text: "Kaleng", value: "kaleng" },
      ],
      managerUp: this.userManager,
      selected: this.userManager.find(
        (u) => u.id === this.userdetail.suppervisor_id
      ),
      listUser: this.users,
      selectedb2b: {},
    };
  },
  computed: {
    selectionPosition() {
      let tempObj = this.position.find(
        (u) => u.org_name === this.form.department
      );
      return this.position.filter((x) => x.org_code === tempObj.org_code);
    },
    iSselectedb2bCmp() {
      if (
        this.userdetail.backtoback_id === "" ||
        this.userdetail.backtoback_id === null
      ) {
        return {
          profile_photo_url: "",
          name: "Please Select One",
          posname: "",
        };
      } else {
        return this.users.find((u) => u.id === this.userdetail.backtoback_id);
      }
    },
  },
  methods: {
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
    submit() {
      let objtDept = this.department.find(
        (u) => u.org_name === this.form.department
      );
      let objetPos = this.position.find(
        (u) => u.position_title === this.form.posname
      );
      this.form.department_code = objtDept.org_code;
      this.form.poscode = objetPos.position_code;
      this.form.suppervisor = this.selected.name;
      this.form.suppervisor_id = this.selected.id;
      this.form.suppervisor_posname = this.selected.posname;

      if(this.selectedb2b.id === ''){
        this.form.backtoback = null;
        this.form.backtoback_id = null;
      } else {
        this.form.backtoback = this.selectedb2b.name;
        this.form.backtoback_id = this.selectedb2b.id;
      }

      this.form.put("/users/" + this.form.id, {
        preserveScroll: true,
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message,'success');
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      });
    },
  },
  mounted() {
    console.log(this.userdetail);
    if(this.userdetail.backtoback_id === null || this.userdetail.backtoback_id === ''){
      this.selectedb2b = {
        profile_photo_url: "https://ui-avatars.com/api/?name=Not+Found&color=7F9CF5&background=EBF4FF",
        name: "Please Chose One",
        posname: ""
      }
    } else {
      this.selectedb2b = this.users.find(
        (u) => u.id === this.userdetail.backtoback_id
      )
    }
  },
});
</script>

<style scoped></style>
