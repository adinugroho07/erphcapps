<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Pegawai Dashboard
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <div class="border-b border-gray-200 dark:border-gray-700 mb-5">
            <ul class="flex flex-wrap -mb-px">
              <li class="mr-2">
                <a href="#" @click.prevent="toggle('basic')" :class="isActiveBasic">
                  <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path></svg>Profile Account
                </a>
              </li>
              <li class="mr-2">
                <a href="#" @click.prevent="toggle('detail')" :class="isActiveDetail" aria-current="page">

                  <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2" />
                  </svg>Account Detail
                </a>
              </li>
              <li class="mr-2">
                <a href="#" @click.prevent="toggle('role')" :class="isActiveRole">
                  <svg class="mr-2 w-5 h-5 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path></svg>Roles
                </a>
              </li>
            </ul>
          </div>
          <jet-form-section >
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
            </template>


            <template v-if="basic" #form>
              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Personel Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>
              <!-- Profile Photo -->
              <div class="col-span-6 sm:col-span-4" v-if="$page.props.jetstream.managesProfilePhotos">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                  <path stroke-linecap="round" stroke-linejoin="round" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                <!-- Profile Photo File Input -->
                <jet-label for="photo" value="Photo Profile" class="font-semibold text-base"/>

                <!-- Current Profile Photo -->
                <div class="mt-2" >
                  <img :src="form.profile_photo_url" :alt="form.name" class="rounded-full h-20 w-20 object-cover">
                </div>

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
                  value="Position Name"
                  class="font-semibold text-base"
                />
                <jet-input id="posname" type="text" class="mt-2 block w-full" v-model="form.posname" disabled/>
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
                <select disabled id="status" name="status" v-model="form.status" class="mt-2 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                  <option v-for="option in options" :selected="form.status === option.value" :key="option.value" :value="option.value">{{option.text}}</option>
                </select>
              </div>

              <!-- Created At -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="createdat" value="Created At" class="font-semibold text-base"/>
                <jet-input id="createdat" type="text" class="mt-2 block w-full" v-model="form.createdat" disabled />
              </div>

              <!-- Update At -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="updatedat" value="Updated At" class="font-semibold text-base"/>
                <jet-input id="updatedat" type="text" class="mt-2 block w-full" v-model="form.updatedat" disabled />
              </div>
            </template>

            <!--detail -->
            <template v-if="detail" #form>
              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Personel Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="named1" value="Name" class="font-semibold text-base"/>
                <jet-input id="named1" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" disabled />
              </div>

              <!-- Email -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                </svg>
                <jet-label for="emaild1" value="Email" class="font-semibold text-base"/>
                <jet-input id="emaild1" type="email" class="mt-2 block w-full" v-model="form.email" disabled/>
              </div>

              <!-- Nik -->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <jet-label for="nik" value="Nik" class="font-semibold text-base"/>
                <jet-input id="nik" type="text" class="mt-2 block w-full" v-model="form.nik" disabled/>
              </div>

              <!-- Department -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                </svg>
                <jet-label for="departmentd1" value="Department" class="font-semibold text-base"/>
                <jet-input id="departmentd1" type="text" class="mt-2 block w-full" v-model="form.department" disabled/>
              </div>

              <!-- Posname -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <jet-label for="posnamed1" value="Position" class="font-semibold text-base"/>
                <jet-input id="posnamed1" type="text" class="mt-2 block w-full" v-model="form.posname" disabled/>
              </div>

              <!-- Supervisor -->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <jet-label for="supervisor" value="Supervisor" class="font-semibold text-base"/>
                <jet-input id="supervisor" type="text" class="mt-2 block w-full" v-model="form.suppervisor" disabled />
              </div>

              <!-- Supervisor posname-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                <jet-label for="supervisor_posname" value="Supervisor Position" class="font-semibold text-base"/>
                <jet-input id="supervisor_posname" type="text" class="mt-2 block w-full" v-model="form.suppervisor_posname" disabled />
              </div>

              <!-- posstatus-->
              <div class="col-span-6 sm:col-span-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                </svg>
                <jet-label for="posstatus" value="Worker Status" class="font-semibold text-base"/>
                <jet-input id="posstatus" type="text" class="mt-2 block w-full" v-model="form.posstatus" disabled />
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
                <jet-input id="expiredcontractdate" v-show="form.posstatus === 'pekerja'" type="text" class="mt-2 block w-full" value="Does Not Have An Expiration Date" disabled />
                <jet-input id="expiredcontractdate" v-show="form.posstatus === 'mitra'" type="text" class="mt-2 block w-full" v-model="form.expiredcontractdate" disabled />
              </div>

              <!-- birthdate-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="birthdate" value="Birthdate" class="font-semibold text-base"/>
                <jet-input id="birthdate" type="text" class="mt-2 block w-full" v-model="form.birthdate" disabled />
              </div>

              <!-- sex-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <jet-label for="sex" value="Gender" class="font-semibold text-base"/>
                <jet-input id="sex" type="text" class="mt-2 block w-full" v-model="form.sex" disabled />
              </div>

              <!-- religion-->
              <div class="col-span-6 sm:col-span-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8" />
                </svg>
                <jet-label for="religion" value="Religion" class="font-semibold text-base"/>
                <jet-input id="religion" type="text" class="mt-2 block w-full" v-model="form.religion" disabled />
              </div>

              <!-- backtoback-->
              <div class="col-span-6 sm:col-span-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
                <jet-label for="backtoback" value="Back To Back" class="font-semibold text-base"/>
                <jet-input id="backtoback" type="text" class="mt-2 block w-full" v-model="form.backtoback" disabled />
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
                <jet-input id="married" type="text" class="mt-2 block w-full" :value="form.married === 1 ? 'Married':'Single'" disabled />
              </div>

              <!-- spouse-->
              <div class="col-span-6 sm:col-span-4" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                </svg>
                <jet-label for="spouse" value="Spouse" class="font-semibold text-base"/>
                <jet-input id="spouse" type="text" class="mt-2 block w-full" v-model="form.spouse" disabled />
              </div>

              <!-- child1-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child1" value="Child 1" class="font-semibold text-base"/>
                <jet-input id="child1" type="text" class="mt-2 block w-full" v-model="form.child1" disabled />
              </div>

              <!-- child2-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child2" value="Child 2" class="font-semibold text-base"/>
                <jet-input id="child2" type="text" class="mt-2 block w-full" v-model="form.child2" disabled />
              </div>

              <!-- child3-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2-1-2 1M4 7l2-1M4 7l2 1M4 7v2.5M12 21l-2-1m2 1l2-1m-2 1v-2.5M6 18l-2-1v-2.5M18 18l2-1v-2.5" />
                </svg>
                <jet-label for="child3" value="Child 3" class="font-semibold text-base"/>
                <jet-input id="child3" type="text" class="mt-2 block w-full" v-model="form.child3" disabled />
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Employee Place Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>



              <!-- state-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                </svg>
                <jet-label for="state" value="Province" class="font-semibold text-base"/>
                <jet-input id="state" type="text" class="mt-2 block w-full" v-model="form.state" disabled />
              </div>

              <!-- city-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
                <jet-label for="city" value="City" class="font-semibold text-base"/>
                <jet-input id="city" type="text" class="mt-2 block w-full" v-model="form.city" disabled />
              </div>

              <!-- postalcode-->
              <div class="col-span-2 sm:col-span-2" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M11 4a2 2 0 114 0v1a1 1 0 001 1h3a1 1 0 011 1v3a1 1 0 01-1 1h-1a2 2 0 100 4h1a1 1 0 011 1v3a1 1 0 01-1 1h-3a1 1 0 01-1-1v-1a2 2 0 10-4 0v1a1 1 0 01-1 1H7a1 1 0 01-1-1v-3a1 1 0 00-1-1H4a2 2 0 110-4h1a1 1 0 001-1V7a1 1 0 011-1h3a1 1 0 001-1V4z" />
                </svg>
                <jet-label for="postalcode" value="Postal Code" class="font-semibold text-base"/>
                <jet-input id="postalcode" type="text" class="mt-2 block w-full" v-model="form.postalcode" disabled />
              </div>

              <!-- address-->
              <div class="col-span-6 sm:col-span-4" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <jet-label for="address" value="Address" class="font-semibold text-base"/>
                <textarea id="address" class="mt-2 border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm" name="address" rows="3" cols="77" v-model="form.address" disabled></textarea>
              </div>

              <div class="col-span-6 sm:col-span-6" >
                <div class="block px-4 py-2 text-sm text-gray-400">
                  Others Employee Information
                </div>
                <div class="border-t border-gray-300"></div>
              </div>

              <!-- bank-->
              <div class="col-span-3 sm:col-span-3" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
                <jet-label for="bank" value="Bank Name" class="font-semibold text-base"/>
                <jet-input id="bank" type="text" class="mt-2 block w-full" v-model="form.bank" disabled />
              </div>

              <!-- bankkey-->
              <div class="col-span-3 sm:col-span-3" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <jet-label for="bankkey" value="Bank Number" class="font-semibold text-base"/>
                <jet-input id="bankkey" type="text" class="mt-2 block w-full" v-model="form.bankkey" disabled />
              </div>

              <!-- phonenum-->
              <div class="col-span-3 sm:col-span-3" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                </svg>
                <jet-label for="phonenum" value="Handphone Number" class="font-semibold text-base"/>
                <jet-input id="phonenum" type="text" class="mt-2 block w-full" v-model="form.phonenum" disabled />
              </div>


            </template>
            <!--detail -->

            <!--role-->
            <template v-if="role" #form>
              <!-- Name -->
              <div class="col-span-6 sm:col-span-6">
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
                <jet-label for="named1" value="Name" class="font-semibold text-base" />
                <jet-input id="namer" type="text" class="mt-2 block w-full disabled:opacity-75" v-model="form.name" autocomplete="name" disabled />
              </div>


              <!-- role-->
              <div class="col-span-6 sm:col-span-6" >
                <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 w-6 float-left h-6 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                </svg>
                <jet-label for="namer" value="User Roles" class="mb-1 mt-2 font-semibold text-base"/>
                <div class="flex flex-row gap-4">
                  <div class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg" >
                    <table class="min-w-full divide-y  divide-gray-200">
                      <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" >
                          No
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Role Name
                        </th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Description
                        </th>
                      </tr>
                      </thead>
                      <tbody class="bg-white divide-y divide-gray-200">
                      <tr v-for="(roles, index) in isHasRoles" :key="roles.id">
                        <td class="px-6 py-4 whitespace-nowrap">
                          <div class="text-sm text-gray-900">
                            {{ index+1 }}
                          </div>
                        </td>

                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" >
                          {{ roles.rolename }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" >
                          {{ roles.description }}
                        </td>

                      </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>


            </template>
            <!--role-->

            <template #actions>
              <Link :href="linkback" class="float-left">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600" >Back</jet-button>
              </Link>
            </template>
          </jet-form-section>
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
    Link
  },
  props:['userdetail','roles','darimana'],
  data(){
    return{
      form: this.$inertia.form({
        name: this.userdetail.name,
        email: this.userdetail.email,
        nik: this.userdetail.nik,
        profile_photo_path: this.userdetail.profile_photo_path,
        profile_photo_url: this.userdetail.profile_photo_url,
        department: this.userdetail.department,
        posname: this.userdetail.posname,
        status: this.userdetail.status,
        createdat: this.userdetail.created_at,
        updatedat: this.userdetail.updated_at,
        suppervisor : this.userdetail.suppervisor,
        suppervisor_posname: this.userdetail.suppervisor_posname,
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
      options:[
        { text: 'Active', value: 'active' },
        { text: 'Non Active', value: 'nonactive' },
      ],
      basic: true,
      detail:false,
      role:false,
      active: 'inline-flex py-4 px-4 text-sm font-medium text-center text-blue-600 rounded-t-lg border-b-2 border-blue-600 active dark:text-blue-500 dark:border-blue-500 group',
      nonactive: 'inline-flex py-4 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 group'
    }
  },
  computed:{
    linkback(){
      if(this.darimana === 'pegawai'){
        return '/pegawai';
      } else {
        return '/users';
      }
    },
    isActiveBasic(){
      if(this.basic){
        return this.active;
      }
      return this.nonactive;
    },
    isActiveDetail(){
      if(this.detail){
        return this.active;
      }
      return this.nonactive;
    },
    isActiveRole(){
      if(this.role){
        return this.active;
      }
      return this.nonactive;
    },
    isHasRoles(){
      //console.log(this.roles.length);
      let returnme = [];
      if(this.roles.length === 0){
        return [
          {
            rolename: "",
            description: ""
          }
        ];
      } else {
        this.roles.forEach(element => {
          let tempObj = {};
          if(element.rolename === 'admin'){
              tempObj = element;
              tempObj.rolename = 'Admin';
              tempObj.description = 'Role yang bisa mengakses ke semua fitur';
          } else if(element.rolename === 'user'){
              tempObj = element;
              tempObj.rolename = 'User';
              tempObj.description = 'Role yang hanya bisa melakukan create document';
          } else if(element.rolename === 'manager'){
              tempObj = element;
              tempObj.rolename = 'Manager';
              tempObj.description = 'Role yang bisa melakukan approval di tinggkat manager';
          } else if(element.rolename === 'srmanager'){
              tempObj = element;
              tempObj.rolename = 'Senior Manager';
              tempObj.description = 'Role yang bisa melakukan approval di tinggkat senior manager';
          } else if(element.rolename === 'generalmanager'){
              tempObj = element;
              tempObj.rolename = 'General Manager';
              tempObj.description = 'Role yang bisa melakukan approval di tinggkat paling tinggi yaitu general manager';
          }
          returnme.push(tempObj);
        })
      }
      return returnme;
    }
  },
  methods:{
    toggle(action){
      console.log(this.isHasRoles);
      if (action === 'basic'){
        this.basic = true;
        this.detail = false;
        this.role = false;
      }

      if (action === 'detail'){
        this.basic = false;
        this.detail = true;
        this.role = false;
      }

      if (action === 'role'){
        this.basic = false;
        this.detail = false;
        this.role = true;
      }
    }
  }
});

</script>
