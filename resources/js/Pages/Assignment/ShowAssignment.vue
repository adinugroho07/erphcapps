<template>
  <app-layout title="Dashboard" pathImage="../image/logo.png">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Assignment Page
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
          <jet-form-section >
            <template #title>
              Assignment Information
            </template>

            <template #description>
              This Page Cotains Information About Workflow Route And Hierarchy Approval.
              You Can Make Your Own Hierarchy Approval. Contact Your System Administrator To Assist You.
            </template>


            <template #form>
              <!-- assignment_code -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_code" value="Assignment Code" />
                <jet-input id="assignment_code" type="text" class="mt-1 block w-full" v-model="assignment.assignment_code" disabled/>
              </div>
              <!-- assignment_code At -->

              <!-- assignment_name -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_name" value="Assignment Name" />
                <jet-input id="assignment_name" type="text" class="mt-1 block w-full" v-model="assignment.assignment_name" autocomplete="name" disabled/>
              </div>
              <!-- assignment_name -->

              <!-- assignment_description -->
              <div class="col-span-6 sm:col-span-4">
                <jet-label for="assignment_description" value="Assignment Description" />
                <textarea id="activiy" disabled placeholder="meeting with someone" rows="6" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full sm:text-sm border border-gray-300 rounded-md" v-model="assignment.assignment_description"></textarea>
              </div>
              <!-- assignment_description -->

              <!-- Assignment Detail -->
              <div class="col-span-6 sm:col-span-6">
                <jet-label for="history" value="Assignment Detail" class="mb-1"/>
                <div id="history" class="shadow overflow-auto border-b border-gray-200 sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200 ">
                    <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignmen Description</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sequence</th>
                      <th scope="col" class="px-3 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Assignment Person</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="(assigndetail,index) in assignmentdetail" :key="assigndetail.sequence">
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.assignment_description }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.status }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.sequence }} </span>
                      </td>
                      <td class="px-3 py-4 whitespace-nowrap">
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold text-gray-900"> {{ assigndetail.assignmeto }} </span>
                      </td>
                    </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- Assignment Detail -->

            </template>

            <template #actions>
              <Link href="/assignment" class="">
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
  name: "ShowAssignment",
  props:['assignment','assignmentdetail'],
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
