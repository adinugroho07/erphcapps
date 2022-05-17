<template>
  <app-layout title="Dashboard">
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
                  <a href="#" @click.prevent="toggle('personal')" :class="isActiveBasic">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>Personal Data
                  </a>
                </li>
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('education')" :class="isActiveDetail" aria-current="page">

                    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                    </svg>Education Data
                  </a>
                </li>
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('attachment')" :class="isActiveRole">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>Attachment
                  </a>
                </li>
                <li class="mr-2">
                  <a href="#" @click.prevent="toggle('history')" :class="isActiveHistory">
                    <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>History Document
                  </a>
                </li>
              </ul>
            </div>
            <div class="md:grid md:grid-cols-3 md:gap-6">
              <div class="md:col-span-1 flex justify-between">
                <div class="px-4 sm:px-0">
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
                      <jet-input id="applicantcode" type="text" class="mt-2 block w-full" v-model="form.applicantcode" disabled/>
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
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in assignment"
                          :key="option.id"
                          :value="option.id"
                          :selected="option.id === this.applicant.assignment_id"
                        >
                          {{ option.assignment_code + " - " + option.assignment_name }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.assignment_id" class="mt-2" />
                    </div>

                    <!-- assignperson -->
                    <div class="col-span-1 sm:col-span-1 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
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


                  </div>
                </div>
              </div>

              <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md">
                  <!-- Personal data -->
                  <div v-show="personal" class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Position Apply.
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
                        v-model="form.department"
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option
                          v-for="option in department"
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
                        disabled
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

                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Personal Data.
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
                      <jet-input id="name" type="text" disabled class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" />
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
                      <jet-input id="email" type="email" disabled class="mt-2 block w-full" v-model="form.email" />
                      <jet-input-error :message="form.errors.email" class="mt-2" />
                    </div>

                    <!-- gender-->
                    <div class="col-span-6 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                      </svg>
                      <jet-label for="gender" value="Gender" class="font-semibold text-base"/>
                      <select
                        id="gender"
                        name="gender"
                        v-model="form.gender"
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsGender"
                          :key="option.value"
                          :value="option.value"
                          :selected="option.value === this.applicant.gender"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.gender" class="mt-2" />
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
                                 disabled
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.birthdate" class="mt-2" />
                    </div>

                    <!-- placeborn -->
                    <div class="col-span-6 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                      </svg>
                      <jet-label
                        for="placeborn"
                        value="Place Born"
                        class="font-semibold text-base"
                      />
                      <jet-input id="placeborn" type="email" disabled class="mt-2 block w-full" v-model="form.placeborn" />
                      <jet-input-error :message="form.errors.placeborn" class="mt-2" />
                    </div>

                    <!-- NIK-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <jet-label for="NIK" value="NIK" class="font-semibold text-base"/>
                      <jet-input
                        id="NIK"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.NIK"
                        disabled
                      />
                      <jet-input-error :message="form.errors.NIK" class="mt-2" />
                    </div>

                    <!-- NPWP-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <jet-label for="NPWP" value="NPWP" class="font-semibold text-base"/>
                      <jet-input
                        id="NPWP"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.NPWP"
                        disabled
                      />
                      <jet-input-error :message="form.errors.NPWP" class="mt-2" />
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
                        disabled
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
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsMarried"
                          :key="option.value"
                          :value="option.value"
                          :selected="option.value === this.applicant.married"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.married" class="mt-2" />
                    </div>

                    <!-- bloodtype-->
                    <div class="col-span-6 sm:col-span-2">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                      </svg>
                      <jet-label for="bloodtype" value="Blood Type" class="font-semibold text-base"/>
                      <select
                        id="bloodtype"
                        name="bloodtype"
                        v-model="form.bloodtype"
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsBlood"
                          :key="option.value"
                          :value="option.value"
                          :selected="option.value === this.applicant.bloodtype"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.bloodtype" class="mt-2" />
                    </div>

                    <!-- phonenumber-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <jet-label for="phonenumber" value="Nomor Handphone" class="font-semibold text-base"/>
                      <jet-input
                        id="phonenumber"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.phonenumber"
                        disabled
                      />
                      <jet-input-error :message="form.errors.phonenumber" class="mt-2" />
                    </div>

                    <!-- degree-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                      </svg>
                      <jet-label for="degree" value="Degree" class="font-semibold text-base"/>
                      <select
                        id="degree"
                        name="degree"
                        v-model="form.degree"
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsDegree"
                          :key="option.value"
                          :value="option.value"
                          :selected="option.value === this.applicant.degree"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.degree" class="mt-2" />
                    </div>


                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Data Tempat Tinggal
                      </div>
                      <div class="border-t border-gray-300"></div>
                    </div>

                    <!-- districts-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="districts" value="Districts" class="font-semibold text-base"/>
                      <jet-input
                        id="districts"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.districts"
                        disabled
                      />
                      <jet-input-error :message="form.errors.districts" class="mt-2" />
                    </div>

                    <!-- city-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="city" value="City" class="font-semibold text-base"/>
                      <jet-input
                        id="city"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.city"
                        disabled
                      />
                      <jet-input-error :message="form.errors.city" class="mt-2" />
                    </div>

                    <!-- address-->
                    <div class="col-span-6 sm:col-span-6" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                      </svg>
                      <jet-label for="address" value="Address" class="font-semibold text-base"/>
                      <textarea id="address" disabled class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="address" rows="3" cols="77" v-model="form.address" ></textarea>
                      <jet-input-error :message="form.errors.address" class="mt-2" />
                    </div>

                    <!-- postalcode-->
                    <div class="col-span-2 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                      </svg>
                      <jet-label for="postalcode" value="Kode Pos" class="font-semibold text-base"/>
                      <jet-input
                        id="postalcode"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.postalcode"
                        disabled
                      />
                      <jet-input-error :message="form.errors.postalcode" class="mt-2" />
                    </div>

                    <!-- citizenship-->
                    <div class="col-span-2 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                      </svg>
                      <jet-label for="citizenship" value="Citizenship" class="font-semibold text-base"/>
                      <jet-input
                        id="citizenship"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.citizenship"
                        disabled
                      />
                      <jet-input-error :message="form.errors.citizenship" class="mt-2" />
                    </div>


                  </div>
                  <!-- Personal data -->
                  <!-- Education data -->
                  <div v-show="education" class="grid grid-cols-6 gap-6">
                    <!-- degree-->
                    <div class="col-span-6 sm:col-span-4">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                      </svg>
                      <jet-label for="degree" value="Last Degree" class="font-semibold text-base"/>
                      <select
                        id="lastdegree"
                        name="lastdegree"
                        v-model="form.lastdegree"
                        disabled
                        class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                      >
                        <option disabled value="">Please select one</option>
                        <option
                          v-for="option in optionsDegree"
                          :key="option.value"
                          :value="option.value"
                          :selected="option.value === this.applicant.lastdegree"
                        >
                          {{ option.text }}
                        </option>
                      </select>
                      <jet-input-error :message="form.errors.lastdegree" class="mt-2" />
                    </div>

                    <!-- major-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <jet-label for="major" value="Major" class="font-semibold text-base"/>
                      <jet-input
                        id="major"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.major"
                        disabled
                      />
                      <jet-input-error :message="form.errors.major" class="mt-2" />
                    </div>

                    <!-- studyprogram-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                      </svg>
                      <jet-label for="studyprogram" value="Program Study" class="font-semibold text-base"/>
                      <jet-input
                        id="studyprogram"
                        type="text"
                        class="mt-2 block w-full"
                        v-model="form.studyprogram"
                        disabled
                      />
                      <jet-input-error :message="form.errors.studyprogram" class="mt-2" />
                    </div>

                    <!-- startschool-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="startschool" value="Start School" class="font-semibold text-base"/>
                      <div class="mt-2 flex items-center justify-center">
                        <div class="datepicker relative form-floating xl:w-96" >
                          <input type="date"
                                 id="startschool"
                                 v-model="form.startschool"
                                 disabled
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.startschool" class="mt-2" />
                    </div>

                    <!-- endschool-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="endschool" value="End School" class="font-semibold text-base"/>
                      <div class="mt-2 flex items-center justify-center">
                        <div class="datepicker relative form-floating xl:w-96" >
                          <input type="date"
                                 id="endschool"
                                 v-model="form.endschool"
                                 disabled
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.endschool" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-6" >
                      <div class="block px-4 py-2 text-sm text-gray-400">
                        Organization Data. <i>Optional*</i>
                      </div>
                      <div class="border-t border-gray-300"></div>
                    </div>

                    <!-- orgname -->
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
                        for="orgname"
                        value="Organization Name"
                        class="font-semibold text-base"
                      />
                      <jet-input id="orgname" type="text" disabled class="mt-2 block w-full disabled:opacity-75" v-model="form.orgname" autocomplete="name" />
                      <jet-input-error :message="form.errors.orgname" class="mt-2" />
                    </div>

                    <!-- positionexporg -->
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
                        for="positionexporg"
                        value="Position In Organization"
                        class="font-semibold text-base"
                      />
                      <jet-input id="positionexporg" type="text" disabled class="mt-2 block w-full disabled:opacity-75" v-model="form.positionexporg" autocomplete="name" />
                      <jet-input-error :message="form.errors.positionexporg" class="mt-2" />
                    </div>

                    <!-- orgdescriptions-->
                    <div class="col-span-6 sm:col-span-6" >
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                      </svg>
                      <jet-label for="orgdescriptions" value="Organization Description" class="font-semibold text-base"/>
                      <textarea disabled id="orgdescriptions" class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="orgdescriptions" rows="3" cols="77" v-model="form.orgdescriptions" ></textarea>
                      <jet-input-error :message="form.errors.orgdescriptions" class="mt-2" />
                    </div>

                    <!-- inorg-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="inorg" value="Start Join Organization" class="font-semibold text-base"/>
                      <div class="mt-2 flex items-center justify-center">
                        <div class="datepicker relative form-floating xl:w-96" >
                          <input type="date"
                                 id="inorg"
                                 v-model="form.inorg"
                                 disabled
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.inorg" class="mt-2" />
                    </div>

                    <!-- outorg-->
                    <div class="col-span-3 sm:col-span-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                      </svg>
                      <jet-label for="outorg" value="End Join Organization" class="font-semibold text-base"/>
                      <div class="mt-2 flex items-center justify-center">
                        <div class="datepicker relative form-floating xl:w-96" >
                          <input type="date"
                                 id="outorg"
                                 v-model="form.outorg"
                                 disabled
                                 class="block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                          />
                        </div>
                      </div>
                      <jet-input-error :message="form.errors.outorg" class="mt-2" />
                    </div>

                  </div>
                  <!-- Education data -->
                  <!-- Attachment data -->
                  <div v-show="attachment" class="grid grid-cols-6 gap-6">
                    <!-- ijazah -->
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
                        for="ijazah"
                        value="Ijazah"
                        class="font-semibold text-base"
                      />
                      <input
                        class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        id="ijazah"
                        @input="form.ijazah = $event.target.files[0]"
                        type="file"
                        disabled
                      >
                      <a target="_blank" v-show="form.ijazah" :href="form.ijazah" class="mt-2 block w-full disabled:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg> Open File
                      </a>
                      <jet-input-error :message="form.errors.ijazah" class="mt-2" />
                    </div>

                    <!-- cv -->
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
                        for="cv"
                        value="Curiculum Vitae"
                        class="font-semibold text-base"
                      />
                      <input class="mt-2 block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                             id="cv"
                             @input="form.cv = $event.target.files[0]"
                             type="file"
                             disabled
                      >
                      <a target="_blank" v-show="form.cv" :href="form.cv" class="mt-2 block w-full disabled:opacity-75">
                        <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg> Open File
                      </a>
                      <jet-input-error :message="form.errors.cv" class="mt-2" />
                    </div>

                  </div>
                  <!-- Attachment data -->

                  <!-- History data -->
                  <div v-show="history" class="grid grid-cols-6 gap-6">

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
                          <tr v-for="(history,index) in recruitmenthistory" :key="history.id">
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
                  </div>
                  <!-- History data -->
                </div>

                <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md">
                  <Link href="/applicant" class="float-left">
                    <jet-button class="bg-cyan-500 hover:bg-cyan-600"
                    >Back</jet-button
                    >
                  </Link>

                </div>
              </div>
            </div>
          </form>
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
import 'mosha-vue-toastify/dist/style.css';
import JetDialogModal from "@/Jetstream/DialogModal";

export default defineComponent({
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
    JetDialogModal
  },
  props:['applicant','assignment','assignmentnow','recruitmenthistory','department','position'],
  data(){
    return{
      show: false,
      assignmentAfterAction: '',
      modalValue: this.$inertia.form({
        applicantcode: this.applicant.applicantcode,
        status: this.applicant.status,
        id: this.applicant.id,
        assignment_id: this.applicant.assignment_id,
        assignment_code: this.applicant.assignment_code,
        memo: '',
        action: ''
      }),
      form: this.$inertia.form({
        status :  this.applicant.status ,
        applicantcode :  this.applicant.applicantcode ,
        assignment_id :  this.applicant.assignment_id ,
        assignment_code :  this.applicant.assignment_code ,
        department: this.applicant.department,
        department_code: this.applicant.department_code,
        posname: this.applicant.posname,
        poscode: this.applicant.poscode,
        isedit :  this.applicant.isedit ,
        action :  this.applicant.action ,
        name :  this.applicant.name ,
        email :  this.applicant.email ,
        gender :  this.applicant.gender ,
        birthdate :  this.applicant.birthdate ,
        placeborn :  this.applicant.placeborn ,
        address :  this.applicant.address ,
        religion :  this.applicant.religion ,
        married :  this.applicant.married ,
        NIK :  this.applicant.NIK ,
        NPWP :  this.applicant.NPWP ,
        bloodtype :  this.applicant.bloodtype ,
        districts :  this.applicant.districts ,
        city :  this.applicant.city ,
        postalcode :  this.applicant.postalcode ,
        citizenship :  this.applicant.citizenship ,
        phonenumber :  this.applicant.phonenumber ,
        degree :  this.applicant.degree ,
        lastdegree :  this.applicant.lastdegree ,
        major :  this.applicant.major ,
        studyprogram :  this.applicant.studyprogram ,
        startschool :  this.applicant.startschool ,
        endschool :  this.applicant.endschool ,
        positionexporg :  this.applicant.positionexporg ,
        orgname :  this.applicant.orgname ,
        orgdescriptions :  this.applicant.orgdescriptions ,
        inorg :  this.applicant.inorg ,
        outorg :  this.applicant.outorg ,
        ijazah :  this.applicant.ijazah ,
        cv : this.applicant.cv ,
      }),
      options:[
        { text: 'Active', value: 'active' },
        { text: 'Non Active', value: 'nonactive' },
      ],
      optionsGender: [
        { text: "Male", value: "male" },
        { text: "Female", value: "female" },
      ],
      optionsBlood: [
        { text: "A", value: "A" },
        { text: "B", value: "B" },
        { text: "AB", value: "AB" },
        { text: "O", value: "O" },
      ],
      optionsDegree: [
        { text: "Post Graduate", value: "s2" },
        { text: "Bachelor", value: "s1" },
        { text: "Senior High School", value: "SMA" },
        { text: "Junior High School", value: "SMP" },
        { text: "College Student", value: "mahasiswa" },
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
      personal: true,
      education:false,
      attachment:false,
      history:false,
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
    isActiveDetail(){
      if(this.education){
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
    isActiveHistory(){
      if(this.history){
        return this.active;
      }
      return this.nonactive;
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
    compAssignperson(){
      console.log(this.assignmentnow);
      if (this.assignmentnow === null){
        return 'There Is No Approval';
      } else {
        if (this.assignmentAfterAction === ''){
          return this.assignmentnow.assignperson;
        } else {
          return this.assignmentAfterAction;
        }
      }
    },
    selectionPosition() {
      let tempObj = {};
      if (this.form.department === ''){
        tempObj = {
          org_code: '',
          org_name: ''
        }
      } else {
        tempObj = this.position.find(
          (u) => u.org_name === this.form.department
        );
      }
      return this.position.filter((x) => x.org_code === tempObj.org_code);
    },
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
      this.modalValue.post(route('applicant.approve'), {
        onSuccess: () => {
          this.notif('Success',this.$page.props.flash.message.message,'success');
          this.form.status = this.$page.props.flash.message.status;
          this.assignmentAfterAction = this.$page.props.flash.message.assignment;
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
      this.modalValue.post(route('applicant.approve'), {
        onSuccess: () => {
          console.log(this.$page.props);
          this.notif('Success',this.$page.props.flash.message.message,'success');
          this.form.status = this.$page.props.flash.message.status;
          this.assignmentAfterAction = this.$page.props.flash.message.assignment;
          this.modalValue.reset('memo');
          this.modalValue.reset('action');
          this.close();
        },
        onError: () => {
          this.notif('Error Occured','Please Read The Errors Message At The Column Field','danger');
        }
      })
    },
    toggle(action){

      if (action === 'personal'){
        this.personal = true;
        this.education = false;
        this.attachment = false;
        this.history = false;
      }

      if (action === 'education'){
        this.personal = false;
        this.education = true;
        this.attachment = false;
        this.history = false;
      }

      if (action === 'attachment'){
        this.personal = false;
        this.education = false;
        this.attachment = true;
        this.history = false;
      }

      if (action === 'history'){
        this.personal = false;
        this.education = false;
        this.attachment = false;
        this.history = true;
      }
    },
  }
});

</script>
