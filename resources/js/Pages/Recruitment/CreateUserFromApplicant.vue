<template>
  <app-layout title="Dashboard" pathImage="../../../../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Recruitment Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <form >
            <div class="border-b border-gray-200 dark:border-gray-700 mb-5">
              <ul class="flex flex-wrap -mb-px">
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('general')" :class="isActiveGeneral">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>Personal Data
                  </a>
                </li>
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('personal')" :class="isActivePersonal" aria-current="page">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>Detail Data
                  </a>
                </li>

              </ul>
            </div>
            <div class="md:grid md:grid-cols-3 ">
              <div class="md:col-span-1 flex justify-between">
                <div class=" sm:px-0">
                  <h3 class="text-lg font-medium text-gray-900">
                    Document And Work Flow Information
                  </h3>
                  <div class="border-t border-gray-300"></div>
                  <p class="mt-1 text-sm text-gray-600">
                    create employee accounts from recruitment data where the recruitment data has been approved by manager-level officials
                  </p>
                  </div>
                </div>

              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">

                  <!-- General data -->
                  <div v-show="general" class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Employee General Information
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
                      <jet-input id="name" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" disabled />
                      <jet-input-error :message="form.errors.name" class="mt-2" />
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
                      <jet-input id="email" type="email" class="mt-2 block w-full" v-model="form.email" disabled/>
                      <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>


                    <!-- Status -->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                      </svg>
                      <jet-label
                        for="status"
                        value="Status Account"
                        class="font-semibold text-base"
                      />
                      <select id="status" name="status" v-model="form.status" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option v-for="option in options" disabled :selected="form.status === option.value" :key="option.value" :value="option.value">{{option.text}}</option>
                      </select>
                      <jet-input-error :message="form.errors.status" class="mt-2" />
                    </div>

                    <!-- position_category -->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                      </svg>
                      <jet-label
                        for="position_category"
                        value="Position Category"
                        class="font-semibold text-base"
                      />
                      <select id="position_category" name="position_category" v-model="form.position_category" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option v-for="option in optionposcat" :selected="form.position_category === option.value" :key="option.value" :value="option.value">{{option.text}}</option>
                      </select>
                      <jet-input-error :message="form.errors.position_category" class="mt-2" />
                    </div>
                  </div>
                  <!-- General data -->

                  <!-- Personal data -->
                  <div v-show="personal" class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Employee Personal Information
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
                      <jet-input id="name" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" disabled />
                      <jet-input-error :message="form.errors.name" class="mt-2" />
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
                      <jet-input id="email" type="email" class="mt-2 block w-full" v-model="form.email" disabled/>
                      <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>

                    <!-- Nik -->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                      <jet-label for="nik" value="Nik" class="font-semibold text-base"/>
                      <jet-input id="nik" type="text" class="mt-2 block w-full" v-model="form.nik" />
                      <jet-input-error :message="form.errors.nik" class="mt-2" />
                    </div>

                    <!-- Department -->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                      </svg>
                      <jet-label for="departmentd1" value="Department" class="font-semibold text-base"/>
                      <jet-input id="departmentd1" type="text" class="mt-2 block w-full" v-model="form.department" disabled/>
                      <jet-input-error :message="form.errors.department" class="mt-2" />
                    </div>

                    <!-- Posname -->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                      </svg>
                      <jet-label for="posnamed1" value="Position" class="font-semibold text-base"/>
                      <jet-input id="posnamed1" type="text" class="mt-2 block w-full" v-model="form.posname" disabled/>
                      <jet-input-error :message="form.errors.posname" class="mt-2" />
                    </div>

                    <!-- Supervisor -->
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
                      <jet-input-error :message="form.errors.suppervisor" class="mt-2" />
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
                        v-model="supvposname"
                        disabled
                      />
                    </div>

                    <!-- posstatus-->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                      </svg>
                      <jet-label for="posstatus" value="Employee Status" class="font-semibold text-base"/>
                      <select
                        id="posstatus"
                        name="posstatus"
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
                      <jet-input-error :message="form.errors.posstatus" class="mt-2" />
                    </div>

                    <!-- expiredcontractdate-->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label
                        for="expiredcontractdate"
                        value="Employee Expired Contract"
                        class="font-semibold text-base"
                      />
                      <jet-input id="expiredcontractdate" v-show="form.posstatus === 'pekerja'" type="text" class="mt-2 block w-full" value="Does Not Have An Expiration Date" disabled />
                      <jet-input id="expiredcontractdate" v-show="form.posstatus === 'mitra'" type="date" class="mt-2 block w-full" v-model="form.expiredcontractdate" />
                      <jet-input-error :message="form.errors.expiredcontractdate" class="mt-2" />
                    </div>

                    <!-- birthdate-->
                    <div class="col-span-3 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="birthdate" value="Birthdate" class="font-semibold text-base"/>
                      <div class="mt-2 flex items-center justify-center">
                        <div class="datepicker relative form-floating xl:w-96" >
                          <input type="date"
                                 id="birthdate"
                                 v-model="form.birthdate"
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.birthdate" class="mt-2" />
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
                        <jet-input-error :message="form.errors.sex" class="mt-2" />
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
                        name="religion"
                        v-model="form.religion"
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsReligion"
                          :key="option.value"
                          :value="option.value"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.religion" class="mt-2" />
                    </div>

                    <!-- backtoback-->
                    <div class="col-span-6 sm:col-span-4">
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

                    <div class="col-span-6 sm:col-span-6" >
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
                      <jet-input-error :message="form.errors.married" class="mt-2" />
                    </div>

                    <!-- spouse-->
                    <div class="col-span-6 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                      </svg>
                      <jet-label for="spouse" value="Spouse" class="font-semibold text-base"/>
                      <jet-input
                        id="spouse"
                        type="text"
                        class="mt-2 block w-full"
                        :disabled="familyDisabled"
                        v-model="form.spouse"
                      />
                      <jet-input-error :message="form.errors.spouse" class="mt-2" />
                    </div>

                    <!-- child1-->
                    <div class="col-span-2 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                      </svg>
                      <jet-label for="child1" value="Child 1" class="font-semibold text-base"/>
                      <jet-input
                        id="child1"
                        type="text"
                        class="mt-2 block w-full"
                        :disabled="familyDisabled"
                        v-model="form.child1"
                      />
                      <jet-input-error :message="form.errors.child1" class="mt-2" />
                    </div>

                    <!-- child2-->
                    <div class="col-span-2 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                      </svg>
                      <jet-label for="child2" value="Child 2" class="font-semibold text-base"/>
                      <jet-input
                        id="child2"
                        type="text"
                        class="mt-2 block w-full"
                        :disabled="familyDisabled"
                        v-model="form.child2"
                      />
                      <jet-input-error :message="form.errors.child2" class="mt-2" />
                    </div>

                    <!-- child3-->
                    <div class="col-span-2 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                      </svg>
                      <jet-label for="child3" value="Child 3" class="font-semibold text-base"/>
                      <jet-input
                        id="child3"
                        type="text"
                        class="mt-2 block w-full"
                        :disabled="familyDisabled"
                        v-model="form.child3"
                      />
                      <jet-input-error :message="form.errors.child3" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-6" >
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
                      <jet-label for="state" value="Province" class="font-semibold text-base"/>
                      <jet-input
                        id="state"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.state"
                      />
                      <jet-input-error :message="form.errors.state" class="mt-2" />
                    </div>

                    <!-- city-->
                    <div class="col-span-2 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                      </svg>
                      <jet-label for="city" value="City" class="font-semibold text-base"/>
                      <jet-input
                        id="city"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.city"
                      />
                      <jet-input-error :message="form.errors.city" class="mt-2" />
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
                      <jet-input-error :message="form.errors.postalcode" class="mt-2" />
                    </div>

                    <!-- address-->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                      </svg>
                      <jet-label for="address" value="Addrees" class="font-semibold text-base"/>
                      <textarea
                        id="address"
                        class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
                        name="address"
                        rows="3"
                        cols="77"
                        v-model="form.address"
                      ></textarea>
                      <jet-input-error :message="form.errors.address" class="mt-2" />
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
                      <jet-input-error :message="form.errors.bank" class="mt-2" />
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
                      <jet-input-error :message="form.errors.bankkey" class="mt-2" />
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
                      <jet-input-error :message="form.errors.phonenum" class="mt-2" />
                    </div>

                  </div>
                  <!-- Personal data -->


                </div>
                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                  <Link :href="route('applicant.listcreateuser')" class="float-left">
                    <jet-button class="bg-cyan-500 hover:bg-cyan-600"
                    >Back</jet-button
                    >
                  </Link>
                  <jet-button
                    class="ml-2 bg-cyan-500 hover:bg-cyan-600 object-left"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                    type="button"
                    @click.prevent = "submit"
                  >
                    Create User
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
import AppLayout from "@/Layouts/AppLayout";
import JetActionMessage from "@/Jetstream/ActionMessage";
import JetButton from "@/Jetstream/Button";
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
  name: "CreateUserFromApplicant",
  components: {
    AppLayout,
    JetActionMessage,
    JetButton,
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
  props:['applicant','userManager','department','position','users'],
  data() {
    return {
      form: this.$inertia.form({
        applicantid: '',
        name: '',
        email: '',
        nik: '',
        profile_photo_path: '',
        profile_photo_url: '',
        department: '',
        position_category: '',
        posname: '',
        status: '',
        suppervisor: '',
        suppervisor_posname: '',
        suppervisor_id: '',
        department_code: '',
        poscode: '',
        expiredcontractdate: '',
        posstatus: '',
        sex: '',
        birthdate: '',
        religion: '',
        spouse: '',
        child1: '',
        child2: '',
        child3: '',
        married: '',
        state: '',
        city: '',
        phonenum: '',
        postalcode: '',
        address: '',
        bank: '',
        bankkey: '',
        backtoback_id: '',
        backtoback: '',
      }),
      options: [
        { text: "Active", value: "active" },
        { text: "Non Active", value: "nonactive" },
      ],
      optionposcat: [
        { text: "General Manager", value: "GM" },
        { text: "Vice President", value: "VP" },
        { text: "Staff", value: "STAFF" },
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
      selected: this.userManager[0],
      listUser: this.users,
      selectedb2b: {
            id: '',
            profile_photo_url: "https://ui-avatars.com/api/?name=Not+Found&color=7F9CF5&background=EBF4FF",
            name: "Please Chose One",
            posname: ""
          },
      general: true,
      personal: false,
      active: 'inline-flex py-4 px-4 text-sm font-medium text-center text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group',
      nonactive: 'inline-flex py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 group'

    };
  },
  computed:{
    isActiveGeneral(){
      if(this.general){
        return this.active;
      }
      return this.nonactive;
    },
    isActivePersonal(){
      if(this.personal){
        return this.active;
      }
      return this.nonactive;
    },
    familyDisabled(){
      if (this.form.married === 0){
        return true;
      }
      return false;
    },
    supvposname(){
      const tempobjetsupvposname = this.userManager.find((u) =>
          u.id === this.selected.id
      );
      this.form.suppervisor = tempobjetsupvposname.name;
      this.form.suppervisor_id = tempobjetsupvposname.id;
      this.form.suppervisor_posname = tempobjetsupvposname.posname;

      return tempobjetsupvposname.posname;
    }
  },
  methods: {
    toggle(action){

      if (action === 'personal'){
        this.personal = true;
        this.general = false;
      }

      if (action === 'general'){
        this.personal = false;
        this.general = true;
      }
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
      console.log(this.form);
      this.form.post(route('applicant.storeuser'), {
        preserveScroll: true,
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message,'success');
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
          console.log(this.form.errors);
          console.log(this.$page.props);
        }
      });
    },
  },
  mounted() {
    this.form.applicantid = this.applicant.id;
    this.form.name = this.applicant.name;
    this.form.email = this.applicant.email;
    this.form.department = this.applicant.department;
    this.form.department_code = this.applicant.department_code;
    this.form.posname = this.applicant.posname;
    this.form.poscode = this.applicant.poscode;
    this.form.birthdate = this.applicant.birthdate;
    this.form.sex = this.applicant.gender;
    this.form.religion = this.applicant.religion;
    this.form.phonenum = this.applicant.phonenumber;
    this.form.state = this.applicant.districts;
    this.form.city = this.applicant.city;
    this.form.address = this.applicant.address;
    this.form.postalcode = this.applicant.postalcode;
    this.form.status = 'active';
    this.form.position_category = 'STAFF';
    this.form.posstatus = 'pekerja';
  },
})
</script>

<style scoped>

</style>
