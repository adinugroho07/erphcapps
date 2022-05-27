<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Roles Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section >
            <template #title>
              Profile Information
            </template>

            <template #description>
              Update your account's profile information and email address.
            </template>


            <template #form>
              <!-- rolecode -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="rolecode" value="Role Code" />
                <jet-input id="rolecode" type="text" class="mt-1 block w-full" v-model="roleheader.rolecode" disabled/>
              </div>
              <!-- rolecode At -->

              <!-- rolename -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="rolename" value="Role Name" />
                <jet-input id="rolename" type="text" class="mt-1 block w-full" v-model="roleheader.rolename" autocomplete="name" disabled/>
              </div>
              <!-- rolename -->

              <!-- created_by -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="created_by" value="Created By" />
                <jet-input id="created_by" type="text" class="mt-1 block w-full" v-model="roleheader.created_by" autocomplete="name" disabled/>
              </div>
              <!-- created_by -->

              <!-- description -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="description" value="Role Description" />
                <textarea id="description" disabled placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" v-model="roleheader.description"></textarea>
              </div>
              <!-- description -->

              <!-- Assignment Detail -->
              <div class="col-span-6 sm:col-span-6">
                <jet-label for="history" value="Assigned User For This Role" class="mb-1"/>
                <div id="history" class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role Code & Rolename</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">User</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Is Extended</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Created At</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(rolesdetail,index) in roledetail" :key="rolesdetail.id">
                      <td class="px-3 py-4 whitespace-nowrap">
                        <div class="text-sm font-medium text-gray-900">
                          {{ rolesdetail.rolecode }}
                        </div>
                        <div class="text-sm text-gray-500">
                          {{ rolesdetail.rolename }}
                        </div>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ rolesdetail.user_name }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ rolesdetail.extend }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5  text-gray-900"> {{ rolesdetail.created_at }} </span>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Assignment Detail -->

            </template>

            <template #actions>
              <Link href="/roleheader" class="">
                <jet-button class="bg-cyan-500 hover:bg-cyan-600 mr-2" >Back</jet-button>
              </Link>

            </template>
          </jet-form-section>
        </div>
      </div>
    </div>

  </app-layout>
</template>

<script>
import JetFormSection from '@/Jetstream/FormSection.vue';
import JetInput from '@/Jetstream/Input.vue';
import JetInputError from '@/Jetstream/InputError.vue';
import JetLabel from '@/Jetstream/Label.vue';
import JetActionMessage from '@/Jetstream/ActionMessage.vue';
import JetButton from '@/Jetstream/Button.vue';
import {defineComponent} from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/AppLayout";

export default defineComponent({
  name: "RoleShow",
  props:['roleheader','roledetail'],
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
  data(){
    return {

    }
  }
})
</script>

<style scoped>

</style>

